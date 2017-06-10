<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check for a list of arrays.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$list = [
    [ 'hello, world!' ]
];
$isArray = check_is_array_list($list);
var_dump($isArray);