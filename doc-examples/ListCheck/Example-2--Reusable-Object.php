<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/IsInRange.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// You can instantiate a ListCheck object. Use this to apply the same conditions
// to multiple lists.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$rangeCheck = new IsInRange(10, 20);

$list1 = [ 11, 13 ];
$list2 = [ 5, 14 ];

var_dump($rangeCheck->inspectList($list1));
var_dump($rangeCheck->inspectList($list2));