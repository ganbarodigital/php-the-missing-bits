<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to spot something that isn't an array.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$isArray = check_is_array('hello, world!');
var_dump($isArray);