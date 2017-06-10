<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you what happens if you pass a non-list into `check_is_array_list()`.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
try {
    $list = 'hello, world!';     // this is not really a list!
    check_is_array_list($list);
}
catch (TypeError $e) {
    echo $e->getMessage() . PHP_EOL;
}