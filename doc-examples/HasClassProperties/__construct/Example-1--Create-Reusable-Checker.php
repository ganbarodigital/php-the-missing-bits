<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to create a customised, reusable checker
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

$checker = new HasClassProperties();
$props = $checker->inspect(ExampleClass::class);
var_dump($props);

$props = $checker->inspect(HasClassProperties::class);
var_dump($props);