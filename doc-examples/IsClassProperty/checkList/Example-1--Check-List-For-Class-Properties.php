<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check if a list contains only class properties.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

$refClass = new ReflectionClass(ExampleClass::class);
$refProp1 = $refClass->getProperty('value1');

// here, $refProp reflects an object's property
$target = new ExampleClass;
$refObj = new ReflectionObject($target);
$refProp2 = $refObj->getProperty('value2');

// this list only contains class properties
var_dump(IsClassProperty::checkList([
    $refProp1
]));

// this list contains both class properties
// and object properties
var_dump(IsClassProperty::checkList([
    $refProp1,
    $refProp2
]));