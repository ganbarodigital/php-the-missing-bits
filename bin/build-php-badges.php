#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$badgeRootPath = ".i/badges";

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

$phpVersions = [
    'PHP_5.6',
    'PHP_7.0',
    'PHP_7.1',
    'PHP_7.2'
];

foreach ($phpVersions as $phpVersion)
{
    makeBadge($phpVersion, 'supported', 'brightgreen', $badgeRootPath);
    makeBadge($phpVersion, 'deprecated', 'yellow', $badgeRootPath);
    makeBadge($phpVersion, 'unsupported', 'orange', $badgeRootPath);
    makeBadge($phpVersion, 'untested', 'orange', $badgeRootPath);
    makeBadge($phpVersion, 'incompatible', 'red', $badgeRootPath);
}
