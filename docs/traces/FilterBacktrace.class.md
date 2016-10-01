# FilterBacktrace class

<div class="callout info">
Since v1.4.0
</div>

## Description

`FilterBacktrace` will search through a `debug_backtrace()` result for the first complete stack frame. You can optionally provide a list of classes and namespaces to skip over.

`FilterBacktrace` is used by [`GetCaller`](GetCaller.class.html).

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
    public function filter($backtrace, $filterList = [], $index = 1);

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

## Methods

Method | Use
-------|----
[`FilterBacktrace::filter()`](FilterBacktrace.filter.html) | object
[`FilterBacktrace::from()`](FilterBacktrace.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Will return global functions
     [x] Will filter out namespaces
     [x] Returns first stack frame when everything else filtered out
     [x] Can search from anywhere in the stack
     [x] Returns last stack frame when starting search beyond the stack

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

## Changelog

### v1.10.0

* The undocumented `FilterBacktrace::__invoke()` was replaced by `FilterBacktrace::filter()`.
