#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Finder\Finder;

function buildExamplePreamble($sourceFile)
{
    $contents = file_get_contents($sourceFile);
    $lines = explode("\n", $contents);

    $retval=[];

    $addingToExample = false;
    foreach ($lines as $line) {
        if ($line === "// --- PREAMBLE START ---") {
            $addingToExample = true;
        }
        else if ($line === "// --- PREAMBLE STOP ---") {
            $addingToExample = false;
        }
        else if ($addingToExample) {
            $retval[] = trim(substr($line, 2));
        }
    }

    return trim(implode(PHP_EOL, $retval));
}

function buildExampleSource($sourceFile)
{
    $contents = file_get_contents($sourceFile);
    $lines = explode("\n", $contents);

    $retval=[];

    $addingToExample = false;
    foreach ($lines as $line) {
        if ($line === "// --- EXAMPLE START ---") {
            $addingToExample = true;
        }
        else if ($line === "// --- EXAMPLE STOP ---") {
            $addingToExample = false;
        }
        else if ($addingToExample) {
            $retval[] = $line;
        }
    }

    return trim(implode(PHP_EOL, $retval));
}

function buildExamplePhpTargets($sourceFile)
{
    $contents = file_get_contents($sourceFile);
    $lines = explode("\n", $contents);

    $targets=[];

    $addingToExample = false;
    foreach ($lines as $line) {
        if ($line === "// --- TARGET START ---") {
            $addingToExample = true;
        }
        else if ($line === "// --- TARGET STOP ---") {
            $addingToExample = false;
        }
        else if ($addingToExample) {
            $targets[] = trim(substr($line, 2));
        }
    }

    // now we need to (potentially) expand the list
    $retval=[];
    $shorthand = [
        "defaults" => [ "5.6", "7.0", "7.1" ],
        "5.x" => [ "5.6" ],
        "7.x" => [ "7.0", "7.1" ],
    ];

    foreach($targets as $target) {
        if (isset($shorthand[$target])) {
            $retval = array_append_values($retval, $shorthand[$target]);
        }
        else {
            $retval[] = $target;
        }
    }

    return $retval;
}

function buildCombinedOutput($capturedOutput)
{
    $retval=[];
    $mergedKeys=[];

    foreach ($capturedOutput as $key1 => $output1) {
        // avoid inception
        if (isset($mergedKeys[$key1])) {
            continue;
        }

        // we're going to want this in its own output block
        $finalKey=[$key1];

        // does anything else match?
        foreach($capturedOutput as $key2 => $output2) {
            // avoid inception
            if ($key1 == $key2) {
                continue;
            }

            // are we already sorted?
            if (isset($mergedKeys[$key2])) {
                continue;
            }

            if ($output1 === $output2) {
                $finalKey[] = $key2;
                $mergedKeys[$key2] = true;
            }
        }

        $retval[implode(", ", $finalKey)] = $output1;
    }

    return $retval;
}

function buildExampleDoc($exampleTitle, $exampleId, $preamble, $source, $capturedOutput)
{
    $retval = <<<EOS
<h3 id="{$exampleId}">{$exampleTitle}</h3>

<p>{$preamble}</p>

<pre><code class="language-php">
{$source}
</code></pre>

EOS;
    foreach ($capturedOutput as $phpVersion => $output) {
        $retval .= <<<EOS
<p>The code above produces this output on {$phpVersion}:</p>

<pre>
{$output}
</pre>
EOS;
    }

    return $retval;
}

// step 1 - our metadata

$examplesDir = __DIR__ . '/../doc-examples/';
$supportedPhpVersions = [
    '5.6' => '$HOME/.phpbrew/php/php-5.6.30/bin/php',
    '7.0' => '$HOME/.phpbrew/php/php-7.0.19/bin/php',
    '7.1' => '$HOME/.phpbrew/php/php-7.1.5/bin/php'
];
$shortVersions=[];
$fullVersions=[];
foreach ($supportedPhpVersions as $key => $cmd) {
    $shortVersions[$key] = 'PHP v' . shell_exec($cmd . ' -r "echo PHP_MAJOR_VERSION . \'.\' . PHP_MINOR_VERSION;"');
    $fullVersions[$key] = 'PHP v' . shell_exec($cmd . ' -r "echo PHP_VERSION;"');
}

// step 2 - find our example files

$finder = new Finder();
$examples = $finder->files()->name("*.php")->notName('*.inc.php')->in($examplesDir);

// step 3 - run them
//
// we run each one in a separate process:
//
// - it avoids nasty fatal error problems
// - it avoids nasty problems with global variables and other state

foreach ($examples as $exampleFile) {
    $sourceFile = $exampleFile->getRelativePathname();
    $destFile = "docs/.i/examples/" . $exampleFile->getRelativePath() . '/' . basename($exampleFile->getFilename(), '.php') . '.twig';

    // build our source
    echo $destFile . PHP_EOL;
    $source = buildExampleSource($examplesDir . $sourceFile);
    $preamble = buildExamplePreamble($examplesDir . $sourceFile);

    // what are we running it against?
    $targets = buildExamplePhpTargets($examplesDir . $sourceFile);

    // get our output
    $capturedOutput = [];
    foreach ($targets as $target) {
        if (!isset($supportedPhpVersions[$target])) {
            continue;
        }

        $phpVersion = $fullVersions[$target];
        $command = $supportedPhpVersions[$target] . ' ' . $examplesDir . $sourceFile;
        // echo $command . PHP_EOL;
        $capturedOutput[$phpVersion] = trim(shell_exec($command));
    }

    // can we combine our output at all?
    $combinedOutput = buildCombinedOutput($capturedOutput);

    // build the doc and save it
    $exampleTitle = ucfirst(str_replace(['--', '-'], [': ', ' '], basename($sourceFile, '.php')));
    $exampleId = strtolower(basename($sourceFile, '.php'));
    $docContents = buildExampleDoc($exampleTitle, $exampleId, $preamble, $source, $combinedOutput);
    file_put_contents($destFile, $docContents);
}

// step 4 - find the included code examples
//
// we want the option of including them in our documentation

$finder = new Finder();
$examples = $finder->files()->name("*.inc.php")->in($examplesDir);

foreach ($examples as $exampleFile) {
    $sourceFile = $exampleFile->getRelativePathname();
    $destFile = "docs/.i/examples/" . $exampleFile->getRelativePath() . '/' . basename($exampleFile->getFilename(), '.php') . '.twig';

    // build our source
    echo $destFile . PHP_EOL;
    $contents = file_get_contents($examplesDir . $sourceFile);

    if (substr($contents, 0, 5) == '<?php') {
        $contents = ltrim(substr($contents, 6));
    }

    file_put_contents($destFile, '<pre><code class="language-php">' . PHP_EOL . $contents . PHP_EOL . '</code></pre>' . PHP_EOL);
}
