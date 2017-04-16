<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows what happens when we combine two associative arrays.
// Note how the values in <code>$extra</code> overwrite the original values
// in <code>$target</code>.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$target = [
    "fish" => "trout",
    "name" => "harry",
    "action" => "met",
];

$extra = [
    "fish" => "salmon",
    "name" => "sally"
];

$newList = array_merge_keys($target, $extra);
var_dump($newList);