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

        // special case - map 'Test' namespace
        if (count($folders) > 4) {
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

        foreach ($folders as $folder) {
            $path .= "/" . $folder;
            if (!is_dir($path)) {
                mkdir($path);
            }
        }
        $path .= "/" . $finalPathPart . ".twig";
        file_put_contents(
            $path,
            '    ' . $contractName . PHP_EOL
            . implode(PHP_EOL, $contractDetails)
            . PHP_EOL
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