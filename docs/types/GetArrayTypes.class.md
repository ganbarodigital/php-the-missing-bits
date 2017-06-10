# GetArrayTypes class

{% include ".i/since/1.3.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetArrayTypes` returns a list of all strict PHP types for a given PHP array. The list is ordered with the most specific match first.

## Public Interface

`GetArrayTypes` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * get a full list of strict types than an array can satisfy
 */
class GetArrayTypes
{
    /**
     * get a full list of strict types than an array can satisfy
     *
     * @param  array $item
     *         the item to examine
     * @return string[]
     *         the array's list of types
     */
    public function getArrayTypes($item);

    /**
     * get a full list of strict types than an array can satisfy
     *
     * @param  array $item
     *         the item to examine
     * @return string[]
     *         the array's list of types
     */
    public static function from($item);
}
```

## Methods

Method | Use
-------|----
[`GetArrayTypes::getArrayTypes()`](GetArrayTypes.getArrayTypes.html) | object
[`GetArrayTypes::from()`](GetArrayTypes.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Detects callable arrays
     [x] Rejects non arrays

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
