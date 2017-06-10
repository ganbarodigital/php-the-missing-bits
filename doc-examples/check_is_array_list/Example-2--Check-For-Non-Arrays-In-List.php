<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to catch a list that contains non-arrays.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$list = [
    [ 'hello, world!'], // this is okay
    'hello, world!'     // this is not okay
];
$isArray = check_is_array_list($list);
var_dump($isArray);