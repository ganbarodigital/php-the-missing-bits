# GetPrintableType class

{% include ".i/since/1.1.0.twig" %}

## Description

`GetPrintableType` returns the PHP type of the data that you pass to it.

It is designed for use in error logging and exception messages. It is a replacement for PHP's built-in `gettype()` function.

## Public Interface

`GetPrintableType` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * GetPrintableType will tell you the PHP data type of any given input data.
 */
class GetPrintableType
{
    /**
     * use this flag for minimum output
     * @var int
     */
    const FLAG_NONE = 0;

    /**
     * use this flag to see classnames in the return value
     * @var int
     */
    const FLAG_CLASSNAME = 1;

    /**
     * use this flag to see what kind of callable `$item` is
     * @var int
     */
    const FLAG_CALLABLE_DETAILS = 2;

    /**
     * use this flag to see the value of `$item`
     * @var int
     */
    const FLAG_SCALAR_VALUE = 4;

    /**
     * current maximum possible value for `$flags`
     * @var int
     */
    const FLAG_MAX_VALUE = 7;

    /**
     * default value for `$flags` if you don't provide one
     * @var int
     */
    const FLAG_DEFAULTS = 7;

    /**
     * what PHP type is $item?
     *
     * @param  mixed $item
     *         the data to examine
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $item
     */
    public function getPrintableType($item, $flags = self::FLAG_DEFAULTS);

    /**
     * what PHP type is $item?
     *
     * @param  mixed $item
     *         the data to examine
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $item
     */
    public static function of($item, $flags = self::FLAG_DEFAULTS);
}
```

## Methods

Method | Use
-------|----
[`GetPrintableType::getPrintableType()`](GetPrintableType.getPrintableType.html) | object
[`GetPrintableType::of()`](GetPrintableType.of.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Will use default flags if invalid flags provided

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
