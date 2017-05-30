<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check if a class has private properties.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$props = has_class_properties(ExampleClass::class, ReflectionProperty::IS_PRIVATE);
var_dump($props);