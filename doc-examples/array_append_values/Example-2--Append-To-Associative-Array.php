<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows what happens when we use <code>array_append_values()</code>
// to append to an associative array.
//
// As you can see, the result isn't all that useful!
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$target = [
    "fish" => "trout",
    "name" => "harry"
];

$extra = [
    "fish" => "salmon",
    "name" => "sally"
];

$newList = array_append_values($target, $extra);
var_dump($newList);