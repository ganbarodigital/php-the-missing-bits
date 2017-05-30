<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check if a class has protected properties.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

$props = HasClassProperties::check(
    ExampleClass::class,
    ReflectionProperty::IS_PROTECTED
);
var_dump($props);