<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/ExampleClass.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check if a property is a class property.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

$checker = new IsClassProperty;

// here, $refProp reflects a static property
$refClass = new ReflectionClass(ExampleClass::class);
$refProp = $refClass->getProperty('value1');
var_dump($checker->inspect($refProp));

// here, $refProp reflects an object's property
$target = new ExampleClass;
$refObj = new ReflectionObject($target);
$refProp = $refObj->getProperty('value2');
var_dump($checker->inspect($refProp));
