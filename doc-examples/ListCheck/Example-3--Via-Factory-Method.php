<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/IsInRange.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// The `using()` method is a static factory method. It returns a `ListCheck` object.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$list = [ 15, 17 ];
var_dump(IsInRange::using(10,20)->inspectList($list));