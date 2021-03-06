<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to get the protected properties of a class.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---

use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;

$filter = new FilterClassProperties(
    ReflectionProperty::IS_PROTECTED
);
$props = $filter->filterClassProperties(
    ExampleClass::class
);
var_dump($props);