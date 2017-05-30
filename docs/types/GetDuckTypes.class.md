# GetDuckTypes class

{% include ".i/since/1.3.0.twig" %}

## Description

`GetDuckTypes` returns a list of all possible PHP types for a given variable. The list is ordered with the most specific match first.

## Public Interface

`GetDuckTypes` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * return a practical list of data types for any value or variable
 */
class GetDuckTypes
{
    /**
     * return a practical list of data types for any value or variable
     *
     * @param  mixed $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public function getDuckTypes($item);

    /**
     * return a practical list of data types for any value or variable
     *
     * @param  mixed $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public static function from($item);
}
```

## Methods

Method | Use
-------|----
[`GetDuckTypes::getDuckTypes()`](GetDuckTypes.getDuckTypes.html) | object
[`GetDuckTypes::from()`](GetDuckTypes.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetDuckTypes
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Can get interface names
     [x] Detects callable arrays
     [x] Detects invokeable objects
     [x] Detects stringy objects
     [x] treats stdClass as Traversable
     [x] Detects stringy classnames
     [x] Detects callable strings
     [x] Detects interfaces

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
