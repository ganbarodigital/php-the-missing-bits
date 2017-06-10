# GetCaller class

{% include ".i/since/1.4.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetCaller` examines a `debug_backtrace()` to work out who has called your code.

It was introduced for use in error logging and exception messages.

## Public Interface

`GetCaller` has the following public interface:

```php
// GetCaller lives in this namespace
namespace GanbaroDigital\MissingBits\TraceInspectors;

// our return types
use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;

class GetCaller
{
    /**
     * work out who has called a piece of code
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @return StackFrame
     */
    public function getCaller($backtrace, $filterList = []);

    /**
     * work out who has called a piece of code
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @return StackFrame
     */
    public static function from($backtrace, $filterList = []);
}
```

## Methods

Method | Use
-------|----
[`GetCaller::getCaller()`](GetCaller.getCaller.html) | object
[`GetCaller::from()`](GetCaller.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TraceInspectors\GetCaller
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Can call as function without trace
     [x] Will return global functions
     [x] Will filter out namespaces
     [x] Returns first stack frame when everything else filtered out

Class contracts are built from this class's unit tests.

<div class="callout success">
Future releases of this class will not break this contract.
</div>

<div class="callout info" markdown="1">
Future releases of this class may add to this contract. New additions may include:

* clarifying existing behaviour (e.g. stricter contract around input or return types)
* add new behaviours (e.g. extra trait methods)
</div>

<div class="callout warning" markdown="1">
When you use this class, you can only rely on the behaviours documented by this contract.

If you:

* find other ways to use this class,
* or depend on behaviours that are not covered by a unit test,
* or depend on undocumented internal states of this class,

... your code may not work in the future.
</div>

## Notes

None at this time.

{% include ".i/supports/5.6-7.x.twig" %}

## Changelog

### v1.10.0

* `GetCaller::__invoke()` was replaced by `GetCaller::getCaller()`.
