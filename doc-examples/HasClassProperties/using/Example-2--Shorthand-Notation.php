<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you the shorthand notation, to avoid creating a
// variable in your code.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

$props = HasClassProperties::using(
    ReflectionProperty::IS_PROTECTED
)->inspect(ExampleClass::class);
var_dump($props);