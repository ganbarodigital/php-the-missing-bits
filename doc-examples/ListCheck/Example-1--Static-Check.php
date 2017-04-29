<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/IsInRange.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// Most of the time, a static call is the most convenient way to use a ListCheck.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$list = [ 11, 15 ];
var_dump(IsInRange::checkList($list, 10,20));