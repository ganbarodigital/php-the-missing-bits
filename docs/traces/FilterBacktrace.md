---
currentSection: traces
currentItem: FilterBacktrace
pageflow_prev_url: index.html
pageflow_prev_text: Stack Trace Functions and Classes
pageflow_next_url: StackFrame.html
pageflow_next_text: StackFrame class
---

# FilterBacktrace

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`FilterBacktrace` will search through a `debug_backtrace()` result for the first complete stack frame. You can optionally provide a list of classes and namespaces to skip over.

`FilterBacktrace` is used by [`GetCaller`](GetCaller.html).

## Public Interface

`FilterBacktrace` has the following public interface:

```php
// FilterBacktrace lives in this namespace
namespace GanbaroDigital\MissingBits\TraceInspectors;

/**
 * find the first entry in a debug_backtrace() array that contains useful
 * information, with optional support for skipping over namespaces
 */
class FilterBacktrace
{
    /**
     * find first complete stack frame, optionally skipping over classes
     * and namespaces
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @param  int $index
     *         how far down the stack do we want to start looking from?
     * @return array
     */
    public function __invoke($backtrace, $filterList = [], $index = 1);

    /**
     * find first complete stack frame, optionally skipping over classes
     * and namespaces
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @param  int $index
     *         how far down the stack do we want to start looking from?
     * @return array
     */
    public static function from($backtrace, $filterList = [], $index = 1);
}
```

## How To Use

### Find Out Who Called Your Code

Use `FilterBacktrace` to work out who called your code (although you should use [`GetCaller`](GetCaller.html) instead).

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
    $caller = FilterBacktrace::from($trace);
    var_dump($caller);
}

foo();
```

### Filtering Out Classes And Namespaces

Use the second parameter to `FilterBacktrace` to skip over calls from specific classes and namespaces:

```php
namespace Vendor\MyLibrary\Robustness;

use GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace;
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;

class RejectStrings
{
    public function check($item)
    {
        if (!is_string($item)) {
            return;
        }

        // if we get here, we have rejected the input value
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $frame = FilterBacktrace::from($trace, [
            self::class,
            GetNamespace::from(self::class),
        ]);
        $caller = '';
        if (isset($frame['class'])) {
            $caller = $frame['class'] . $frame['type'];
        }
        $caller .= $frame['function'];

        // tell people who does not accept strings
        throw new \RuntimeException("{$caller} - items cannot be strings");
    }
}
```

## Notes

None at this time.

## Works With

`GetArrayTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Untested
