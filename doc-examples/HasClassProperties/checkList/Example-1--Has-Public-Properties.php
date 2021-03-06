<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClasses.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check if a list of classes has public properties.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

// all of these classes have public properties
// the check will return TRUE
$props = HasClassProperties::checkList([
    ExampleClass1::class,
    ExampleClass2::class
]);
var_dump($props);

// ExampleClass3 does *not* have any public properties
// the check will return FALSE
$props = HasClassProperties::checkList([
    ExampleClass1::class,
    ExampleClass2::class,
    ExampleClass3::class,
]);
var_dump($props);