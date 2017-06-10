#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$statsFilename = "review/logs/phpunit.xml";

if (!file_exists($statsFilename)) {
    echo "*** error: run phpunit first with code coverage functioning" . PHP_EOL;
    exit(1);
}

$rootPath = ".i/code-metrics";
$badgeRootPath = ".i/badges";

// remove all the old metrics first
// in case some of them are no longer needed
system("rm -r ./docs/{$rootPath}/*");

// parse the contents of a file
function parsePackageFileNode($fileNode)
{
    $retval = [];
    $className = null;
    $metrics = [];

    $currentMethod = null;
    $currentVisibility = null;

    foreach ($fileNode->children() as $node) {
        // echo $node->getName() . PHP_EOL;
        switch ((string)$node->getName()) {
            case 'class':
                // which class are we looking at?
                $partialClassName = (string)$node['name'];
                $namespace = (string)$node['namespace'];
                $className = $namespace . '\\' . $partialClassName;

                // what metrics are reported?
                foreach ($node->metrics->attributes() as $name => $value) {
                    $metrics[(string)$name] = intval($value);
                }

                break;
            case 'line':
                // parse the line
                switch ((string)$node['type']) {
                    case 'method':
                        $currentMethod = (string)$node['name'];
                        $retval[$className][$currentMethod] = [
                            'visibility' => (string)$node['visibility'],
                            'complexity' => intval($node['complexity']),
                            'CRAP' => intval($node['crap']),
                            'noOfLines' => 0,
                            'noOfCoveredLines' => 0,
                        ];
                        break;

                    case 'stmt':
                        $retval[$className][$currentMethod]['noOfLines']++;
                        if (intval($node['count']) > 0) {
                            $retval[$className][$currentMethod]['noOfCoveredLines']++;
                        }
                        break;
                }
                break;
        }
    }

    // all done
    return $retval;
}

// let's load it up
$xml = simplexml_load_file($statsFilename);

// global stats
$when = DateTime::createFromFormat("U", (string)$xml->project['timestamp']);

// extract the per-method, per-function stats
$functionStats=[];
$classStats=[];

foreach ($xml->project->children() as $projectNode) {
    switch ((string)$projectNode->getName()) {
        case 'file':
            // echo "Found a file node" . PHP_EOL;
            // do nothing for now - the clover file does not contain
            // code coverage information for individual functions
            break;
        case 'package':
            // echo "Found a package node" . PHP_EOL;
            foreach ($projectNode->file as $fileNode) {
                //echo "Parsing file node" . PHP_EOL;
                $classStats = array_merge_keys($classStats, parsePackageFileNode($fileNode));
            }
            break;
        default:
            //echo $projectNode->getName() . PHP_EOL;
    }
}

function makePathToFilename($filename)
{
    $folders = explode('/', $filename);
    $folderKeys = array_keys($folders);
    $finalIndex = end($folderKeys);
    $finalPathPart = $folders[$finalIndex];
    unset($folders[$finalIndex]);

    $path = '.';

    foreach ($folders as $folder) {
        $path .= '/' . $folder;
        if (!is_dir($path)) {
            mkdir($path);
        }
    }
}

function makeBadge($text, $value, $color, $rootPath)
{
    // we cache the badges on disk to avoid hitting shields.io all
    // the time
    $badgeFilename = './docs/' . $rootPath . "/$text-$value.svg";
    if (!file_exists($badgeFilename)) {

        $badge = false;
        while (!$badge || empty($badge)) {
            $badge = file_get_contents("https://img.shields.io/badge/{$text}-{$value}-{$color}.svg?style=flat-square");
            if (!$badge || empty($badge)) {
                sleep(1);
            }
        }

        makePathToFilename($badgeFilename);
        file_put_contents($badgeFilename, $badge);
    }

    // return the SVG off disk
    return file_get_contents($badgeFilename);
}

// write out the class stats
foreach ($classStats as $className => $methods) {
    foreach ($methods as $methodName => $methodDetails) {
        // skip over private methods
        //
        // they go undocumented
        if ($methodDetails['visibility'] !== 'private' && $methodDetails['visibility'] != 'public') {
            continue;
        }

        $docPath = "./docs/{$rootPath}/{$className}.{$methodName}";
        $docPath = str_replace('\\', '/', $docPath);

        // we need to create the images
        $codeCoverage = 0.0;
        if ($methodDetails['noOfLines'] > 0) {
            $codeCoverage = round($methodDetails['noOfCoveredLines'] / $methodDetails['noOfLines'] * 100.0, 2);
        }
        $color='brightgreen';
        if ($codeCoverage < 50) {
            $color = 'red';
        }
        else if ($codeCoverage < 100) {
            $color = 'yellow';
        }

        $coverageBadge = makeBadge('coverage', $codeCoverage, $color, $badgeRootPath);

        $complexity = $methodDetails['complexity'];
        $color = 'brightgreen';
        if ($complexity > 4) {
            $color = 'yellow';
        }
        else if ($complexity > 8) {
            $color = 'red';
        }

        $complexityBadge = makeBadge('complexity', $complexity, $color, $badgeRootPath);


        $crap = $methodDetails['CRAP'];
        $color = 'brightgreen';
        if ($crap > 4) {
            $color = 'yellow';
        }
        else if ($crap > 8) {
            $color = 'red';
        }

        $crapBadge = makeBadge('CRAP', $crap, $color, $badgeRootPath);

        // make it easy to include
        $stats = <<<EOS
<div class="code-metrics">
{$coverageBadge}&nbsp;{$complexityBadge}&nbsp;{$crapBadge}
</div>

EOS;
        $docFilename = $docPath . '.twig';
        makePathToFilename($docFilename);
        file_put_contents($docFilename, $stats);
    }
}

