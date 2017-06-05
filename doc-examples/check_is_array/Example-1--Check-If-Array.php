<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// This example shows you how to check for an array.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$isArray = check_is_array([]);
var_dump($isArray);