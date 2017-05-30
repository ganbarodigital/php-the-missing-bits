# GetNumericType

{% include ".i/since/1.3.0.twig" %}

## Description

`GetNumericType` returns `integer` or `double` if the input variable is a numeric type, or can be automatically coerced into a numeric type by PHP.

## Public Interface

`GetNumericType` has the following public interface:

```php
// GetNumericType lives in this namespace
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * do we have a numeric type? if so, what is it?
 */
class GetNumericType
{
    /**
     * do we have a numeric type? if so, what is it?
     *
     * @param  mixed $item
     *         the item to examine
     * @return string|null
     *         the numeric type, or null if it is not numeric
     */
    public function getNumericType($item);

    /**
     * do we have a numeric type? if so, what is it?
     *
     * @param  mixed $item
     *         the item to examine
     * @return string|null
     *         the numeric type, or null if it is not numeric
     */
    public static function from($item);
}
```

## Methods

Method | Use
-------|----
[`GetNumericType::getNumericType()`](GetNumericType.getNumericType.html) | object
[`GetNumericType::from()`](GetNumericType.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetNumericType
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Detects real integers
     [x] Detects real doubles
     [x] Detects numeric strings
     [x] returns NULL for everything else

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

### How To Coerce A Variable Into A Number

To convert a string into one of PHP's numeric types, just add zero to it:

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;

$maybeInt = "100";
$maybeDouble = "3.1415927";

if (GetNumericType::from($maybeInt) !== null) {
    $realInt = $maybeInt + 0;
}
if (GetNumericType::from($maybeDouble) !== null) {
    $realDouble = $maybeDouble + 0;
}
var_dump($realInt);
var_dump($realDouble);
```

This example code outputs:

    int(100)
    float(3.1415927)
