#!/usr/bin/env php
<?php

$testdoxFilename = "review/testdox.txt";

if (!file_exists($testdoxFilename)) {
    echo "*** error: run phpunit first" . PHP_EOL;
    exit(1);
}

// remove all the old contract files
// in case some of them are no longer needed
system("rm -r ./docs/.i/contracts/*");

$prefix = <<<EOS
## Behavoural Contract

Here is the behavioural contract, enforced by our unit tests:


EOS;
$suffix = <<<EOS

{% include ".i/boilerplate/behavioural-contract.twig" %}

EOS;

$fd = fopen($testdoxFilename, 'r');

$contractName=null;
$contractDetails=[];

while ($line = fgets($fd)) {
    if (empty(trim($line)) && count($contractDetails) > 0) {

        $targetFolder = "docs/.i/contracts/" . str_replace('\\', '/', $contractName);
        $folders = explode("/", $targetFolder);

        $path = ".";
        $folderKeys = array_keys($folders);
        $finalIndex = end($folderKeys);
        $finalPathPart = $folders[$finalIndex];
        unset($folders[$finalIndex]);

        $isClass = false;

        // special case - map 'Test' namespace
        if (count($folders) > 4) {
            $isClass = true;
            if (substr($folders[3], -4) === 'Test') {
                $folders[3] = substr($folders[3], 0, -4);
            }
            else {
                echo "*** fixme: $contractName is not in the 'Test' namespace" . PHP_EOL;
            }
        }
        // special case - function starts with capitol letter
        else if (strtolower(substr($finalPathPart, 0, 1)) !== substr($finalPathPart, 0, 1)) {
            echo "*** fixme: $contractName starts with a capitol letter" . PHP_EOL;
            $finalPathPart = strtolower(substr($finalPathPart, 0, 1)) . substr($finalPathPart, 1);
        }

        if (!$isClass) {
            $contractName .= '()';
        }
        else {
            $nameParts = explode('\\', $contractName);
            if (substr($nameParts[0], -4) === 'Test') {
                $nameParts[0] = substr($nameParts[0], 0, -4);
            }
            $contractName = implode('\\', $nameParts);
        }

        foreach ($folders as $folder) {
            $path .= "/" . $folder;
            if (!is_dir($path)) {
                mkdir($path);
            }
        }
        $path .= "/" . $finalPathPart . ".twig";
        file_put_contents(
            $path,
            $prefix
            . '    ' . $contractName . PHP_EOL
            . implode(PHP_EOL, $contractDetails)
            . PHP_EOL
            . $suffix
        );

        // reset for the next one
        $contractName = null;
        $contractDetails = [];
    }
    else if ($line{0} == ' ') {
        $contractDetails[] = '     ' . trim($line);
    }
    else {
        $contractName = trim($line);
    }
}