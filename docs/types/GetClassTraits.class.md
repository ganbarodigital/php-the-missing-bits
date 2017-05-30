# GetClassTraits class

{% include ".i/since/1.3.0.twig" %}

## Description

`GetClassTraits` returns a list of all the traits used by a class or object. The list includes all traits used by parent classes, and by the traits in the list too.

`GetClassTraits` is a deeper-inspecting version of PHP's [`class_uses()`](http://php.net/manual/en/function.class-uses.php).

## Public Interface

`GetClassTraits` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * get a full list of the traits used by a class or its parents
 */
class GetClassTraits
{
    /**
     * get a full list of the traits used by a class or its parents
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the class's traits list
     */
    public function getClassTraits($item);

    /**
     * get a full list of the traits used by a class or its parents
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the class's traits list
     */
    public static function from($item);
}
```

## Methods

Method | Use
-------|----
[`GetClassTraits::getClassTraits()`](GetClassTraits.getClassTraits.html) | object
[`GetClassTraits::from()`](GetClassTraits.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetClassTraits
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Detects traits used by classes
     [x] Detects traits used by objects
     [x] Returns empty array for everything else

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
