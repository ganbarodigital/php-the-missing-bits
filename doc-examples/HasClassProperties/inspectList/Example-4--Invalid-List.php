<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClasses.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you what happens if you don't pass a valid list in.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

$checker = new HasClassProperties();

try {
    $props = $checker->inspectList(
        // definitely not a list!
        'hello, world!'
    );
}
catch (TypeError $e) {
    var_dump($e->getMessage());
}
