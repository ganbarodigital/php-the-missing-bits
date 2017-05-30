# FilterBacktrace::from()

{% include ".i/since/1.4.0.twig" %}

## Description

`FilterBacktrace::from()` will search through a `debug_backtrace()` result for the first complete stack frame. You can optionally provide a list of classes and namespaces to skip over.

```php
use GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace;
public static array FilterBacktrace::from($backtrace, $filterList = [], $index = 1);
```

## Parameters

`FilterBacktrace::from()` takes three parameters:

* `$backtrace` (array) - a PHP stack trace (from `debug_backtrace()`)
* `$filterList` (array) - a list of namespaces and classes to skip over
* `$index` (int) - where in `$backtrace` do we want to start looking?

## Return Value

`FilterBacktrace::from()` returns an array:

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

### Find Out Who Called Your Code

Use `FilterBacktrace::from()` to work out who called your code (although you should use [`GetCaller`](GetCaller.class.html) instead).

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

Use the second parameter to `FilterBacktrace::from()` to skip over calls from specific classes and namespaces:

```php
namespace Vendor\MyLibrary\Robustness;

use GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace;
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;

class RejectStrings
{
    public function check($item)
    {
        if (!is_stringy($item)) {
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

{% include ".i/supports/5.6-7.x.twig" %}
