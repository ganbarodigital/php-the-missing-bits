<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to create a reusable filter.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---

use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;

$filter = FilterClassProperties::using(
    ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE
);

var_dump($filter->filterClassProperties(ExampleClass::class));
var_dump($filter->filterClassProperties(FilterClassProperties::class));