# get_caller_from_trace()

{% include ".i/since/1.4.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`get_caller_from_trace()` examines a `debug_backtrace()` to work out who has called your code.

It was introduced for use in error logging and exception messages.

```php
use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;

public StackFrame get_caller_from_trace($backtrace, $filterList = []);
```

## Parameters

The input parameters are:

* `$backtrace` - a `debug_backtrace()` return value to examine
* `$filterList` - optional list of namespaces and classes to skip over

## Return Value

`get_caller_from_trace()` returns a [`StackFrame`](StackFrame.class.html).

## How To Use

### Find Out Who Called You

Use `get_caller_from_trace()` to extract the first full stack frame from a `debug_backtrace()` array.

```php
// call directly
//
// returns a StackFrame
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
$caller = get_caller_from_trace($trace);
echo (string)$caller;
```

### Skip Callers You're Not Interested In

You can give `get_caller_from_trace()` a list of fully-qualified class names or namespaces to ignore. This allows you to put caller-finding code in a shared private method, like this:

```php
// imports
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
        $frame  = get_caller_from_trace($trace, [
            self::class,
            GetNamespace::from(self::class),
        ]);

        return (string)$frame;
    }
}
```

## Throws

`get_caller_from_trace()` does not throw any exceptions.

## Notes

None at this time.

{% include ".i/supports/5.6-7.x.twig" %}
