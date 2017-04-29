<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/IsInRange.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// The `using()` method is a static factory method. It returns a `Check` object.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$data = 15;
var_dump(IsInRange::using(10,20)->inspect($data));