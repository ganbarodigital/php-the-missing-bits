# GetStringDuckTypes class

{% include ".i/since/1.5.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetStringDuckTypes` returns a list of all possible PHP types for a given string. The list is ordered with the most specific match first.

<div class="callout info" markdown="1">
#### Which Type Inspector To Use On Strings?

Both [`GetStringDuckTypes`](GetStringDuckTypes.class.html) and [`GetStringTypes`](GetStringTypes.class.html) will check for:

* objects that implement the `__toString()` method
* strings that contain valid `callable` definitions
* strings that contain doubles and integers

[`GetStringDuckTypes`](GetStringDuckTypes.class.html) will also check for:

* strings that contain valid class names
* strings that contain valid interface names
</div>

## Public Interface

`GetStringDuckTypes` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * get a full list of types that a string might satisfy
 */
class GetStringDuckTypes
{
    /**
     * get a full list of types that a string might satisfy
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public function getStringDuckTypes($item);

    /**
     * get a full list of types that a string might satisfy
     *
     * @param  string $item
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
[`GetStringDuckTypes::getStringDuckTypes()`](GetStringDuckTypes.getStringDuckTypes.html) | object
[`GetStringDuckTypes::from()`](GetStringDuckTypes.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetStringDuckTypes
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Detects callables in strings
     [x] Detects numeric strings
     [x] Detects stringy objects
     [x] returns empty array for everything else

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
