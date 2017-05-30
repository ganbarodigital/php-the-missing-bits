# GetStrictTypes class

{% include ".i/since/1.3.0.twig" %}

## Description

`GetStrictTypes` returns a list of all strict PHP types for a given value or variable. The list is ordered with the most specific match first.

## Public Interface

`GetStrictTypes` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * return any value or variable's type list
 */
class GetStrictTypes
{
    /**
     * return any value or variable's type list
     *
     * @param  mixed $item
     *         the item to examine
     * @return array
     *         the list of type(s) that this item can be
     */
    public function getStrictTypes($item);

    /**
     * return any value or variable's type list
     *
     * @param  mixed $item
     *         the item to examine
     * @return string[]
     *         the basic type of the examined item
     */
    public static function from($item);
}
```

## Methods

Method | Use
-------|----
[`GetStrictTypes::getStrictTypes()`](GetStrictTypes.getStrictTypes.html) | object
[`GetStrictTypes::from()`](GetStrictTypes.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Can get interface names
     [x] Detects callable arrays
     [x] Detects invokeable objects
     [x] Detects stringy objects
     [x] Detects callable strings

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
