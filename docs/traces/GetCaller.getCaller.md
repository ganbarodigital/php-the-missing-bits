# GetCaller::getCaller()

{% include ".i/since/1.10.0.twig" %}

## Description

`GetCaller::getCaller()` examines a `debug_backtrace()` to work out who has called your code.

It was introduced for use in error logging and exception messages.

```php
use GanbaroDigital\MissingBits\TraceInspectors\GetCaller;
use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;

public StackFrame GetCaller::getCaller($backtrace, $filterList = []);
```

## Parameters

The input parameters are:

* `$backtrace` - a `debug_backtrace()` return value to examine
* `$filterList` - optional list of namespaces and classes to skip over

## Return Value

`GetCaller::getCaller()` returns a [`StackFrame`](StackFrame.class.html).

## How To Use

### Find Out Who Called You

Use `GetCaller::getCaller()` to extract the first full stack frame from a `debug_backtrace()` array.

```php
// import
use GanbaroDigital\MissingBits\TraceInspectors\GetCaller;

// call directly
//
// returns a StackFrame
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
$finder = new GetCaller();
$caller = $finder->getCaller($trace);
echo (string)$caller;
```

### Skip Callers You're Not Interested In

You can give `GetCaller::getCaller()` a list of fully-qualified class names or namespaces to ignore. This allows you to put caller-finding code in a shared private method, like this:

```php
// imports
use GanbaroDigital\MissingBits\TraceInspectors\GetCaller;
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;

class RejectStrings
{
    public function check($item)
    {
        if (!is_stringy($item)) {
            return;
        }

        // if we get here, we have rejected the input value
        $caller = $this->findCaller();

        // tell people who does not accept strings
        throw new \RuntimeException("{$caller} - items cannot be strings");
    }

    private function findCaller()
    {
        $trace  = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $finder = new GetCaller();
        $frame  = $finder->getCaller($trace, [
            self::class,
            GetNamespace::from(self::class),
        ]);

        return (string)$frame;
    }
}
```

## Throws

`GetCaller::getCaller()` does not throw any exceptions.

## Notes

None at this time.
