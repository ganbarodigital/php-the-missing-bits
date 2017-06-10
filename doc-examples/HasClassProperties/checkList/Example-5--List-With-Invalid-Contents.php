<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClasses.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you what happens if you pass in a list that contains
// anything other than strings.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

try {
    $props = HasClassProperties::checkList([
        // this is a valid list, but
        // this is not a valid class name
        new stdClass
    ]);
}
catch (TypeError $e) {
    var_dump($e->getMessage());
}
