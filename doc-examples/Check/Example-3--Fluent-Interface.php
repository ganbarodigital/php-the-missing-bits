<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/IsInRange.inc.php';

// --- TARGET START ---
// defaults
// --- TARGET STOP ---
// --- PREAMBLE START ---
// The fluent interface is there for anyone who finds it makes their code more readable.
// --- PREAMBLE STOP ---

// --- EXAMPLE START ---
$data = 15;
var_dump(IsInRange::using(10,20)->inspect($data));
