<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClasses.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you what happens if you pass in a class that doesn't
// exist.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

$checker = new HasClassProperties();

try {
    $props = $checker->inspectList([
        // this is a valid list, but
        // this is not a valid class name
        'hello, world!'
    ]);
}
catch (InvalidArgumentException $e) {
    var_dump($e->getMessage());
}
