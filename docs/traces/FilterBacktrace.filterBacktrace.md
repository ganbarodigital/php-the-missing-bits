# FilterBacktrace::filterBacktrace()

{% include ".i/since/1.10.0.twig" %}

## Description

`FilterBacktrace::filterBacktrace()` will search through a `debug_backtrace()` result for the first complete stack frame. You can optionally provide a list of classes and namespaces to skip over.

```php
use GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace;
public array FilterBacktrace::filterBacktrace($backtrace, $filterList = [], $index = 1);
```

## Parameters

`FilterBacktrace::filterBacktrace()` takes three parameters:

* `$backtrace` (array) - a PHP stack trace (from `debug_backtrace()`)
* `$filterList` (array) - a list of namespaces and classes to skip over
* `$index` (int) - where in `$backtrace` do we want to start looking?

## Return Value

`FilterBacktrace::filterBacktrace()` returns an array:

Key | Description
----|------------
class | A valid PHP class name, or NULL
function | The method on the class that called us, or NULL
file | The file were the PHP code was defined, or NULL
line | The line number in the file where the PHP code was defined, or NULL
stackIndex | Where did we find these details in the backtrace array?

You should expect some of the fields in the return array to be `NULL`:

* Any entry in the returned array can be `NULL`.
* One of `class`, `class` and `function`, or `file` will have a value.

## How To Use

Use `FilterBacktrace::filterBacktrace()` to work out who called your code (although you should use [`GetCaller`](GetCaller.class.html) instead).

```php
use GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace;

function foo()
{
    bar();
}

function bar()
{
    // who called us?
    // use DEBUG_BACKTRACE_IGNORE_ARGS to keep the trace small
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

    /** @var array */
    $traceFilter = new FilterBacktrace;
    $caller = $traceFilter->filterBacktrace($trace);
    var_dump($caller);
}

foo();
```

`FilterBacktrace::filterBacktrace()` is a wrapper around `FilterBacktrace::from()`. See [`FilterBacktrace::from()`](FilterBacktrace.from.html#how-to-use) for details.

## Notes

None at this time.

## Works With

`FilterBacktrace::filterBacktrace()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Untested
