<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows what happens when we combine two lists.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$target = [
    "trout",
    "harry"
];

$extra = [
    "salmon",
    "sally"
];

$newList = array_append_values($target, $extra);
var_dump($newList);