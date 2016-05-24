---
currentSection: traces
currentItem: GetCaller
pageflow_prev_url: FilterBacktrace.html
pageflow_prev_text: FilterBacktrace class
pageflow_next_url: StackFrame.html
pageflow_next_text: StackFrame class
---

# GetPrintableType

<div class="callout info">
Since v1.4.0
</div>

## Description

`GetCaller` examines a `debug_backtrace()` to work out who has called your code.

It was introduced for use in error logging and exception messages.

```php
// how to import
use GanbaroDigital\MissingBits\TraceInspectors\GetCaller;
use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;

// call directly
//
// returns a StackFrame
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
$caller = GetCaller::from($trace);
echo (string)$caller;

// use as an object
//
// returns a StackFrame
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
$inspector = new GetCaller;
$caller = $inspector($trace);
echo (string)$caller;

// use as a global function
//
// returns a StackFrame
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
$caller = get_caller_from_trace($trace);
echo (string)$caller;

// most convenient of all - no need to pass in a trace
$caller = get_caller();
echo (string)$caller;
```

## Parameters

The input parameters are:

* `$backtrace` - a `debug_backtrace()` return value to examine
* `$filterList` - optional list of namespaces and classes to skip over

## Return Value

`GetCaller` returns a [`StackFrame`](StackFrame.html).

## Throws

`GetCaller` does not throw any exceptions.

## Notes

None at this time.

## Works With

`GetCaller` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Untested
