<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/IsInRange.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// You can instantiate a Check object. Use this to apply the same conditions
// to multiple pieces of data.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$rangeCheck = new IsInRange(10, 20);

$data1 = 5;
$data2 = 15;

var_dump($rangeCheck->inspect($data1));
var_dump($rangeCheck->inspect($data2));