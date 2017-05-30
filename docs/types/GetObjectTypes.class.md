# GetObjectTypes

{% include ".i/since/1.3.0.twig" %}

## Description

`GetObjectTypes` returns a list of all strict PHP types for a given PHP object. The list is ordered with the most specific match first.

## Public Interface

`GetObjectTypes` has the following public interface:

```php
// GetObjectTypes lives in this namespace
namespace GanbaroDigital\MissingBits\TypeInspectors;

class GetObjectTypes
{
    /**
     * get a full list of an objects's inheritence hierarchy and other types
     * that it can satisfy
     *
     * @param  object $item
     *         the item to examine
     * @return string[]
     *         the object's list of types
     */
    public function getObjectTypes($item);

    /**
     * get a full list of an objects's inheritence hierarchy and other types
     * that it can satisfy
     *
     * @param  object $item
     *         the item to examine
     * @return string[]
     *         the object's list of types
     */
    public static function from($item);
}

```

## Methods

Method | Use
-------|----
[`GetObjectTypes::getObjectTypes()`](GetObjectTypes.getObjectTypes.html) | object
[`GetObjectTypes::from()`](GetObjectTypes.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Can get interface names
     [x] Detects invokeable objects
     [x] Detects stringy objects
     [x] Returns empty array for non objects

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
