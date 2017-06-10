# GetNamespace class

{% include ".i/since/1.4.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetNamespace` returns a class or object's namespace.

## Public Interface

`GetNamespace` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

use InvalidArgumentException;

/**
 * what namespace does a class live within?
 */
class GetNamespace
{
    /**
     * what namespace does a class live within?
     *
     * @param  string|object $item
     *         the item to examine
     * @return string
     *         the class's namespace
     * @throws InvalidArgumentException
     *         - if we have not been given a string or object
     *         - if the string does not contain the name of a defined
     *           class / interface / trait
     */
    public function getNamespace($item);

    /**
     * what namespace does a class live within?
     *
     * @param  string|object $item
     *         the item to examine
     * @return string
     *         the class's namespace
     * @throws InvalidArgumentException
     *         - if we have not been given a string or object
     *         - if the string does not contain the name of a defined
     *           class / interface / trait
     */
    public static function from($item);
}
```

## Methods

Method | Use
-------|----
[`GetNamespace::getNamespace()`](GetNamespace.getNamespace.html) | object
[`GetNamespace::from()`](GetNamespace.from.html) | static

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\GetNamespace
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Returns namespaces from classes
     [x] Returns namespaces from objects
     [x] Returns empty string for classes with no namespace
     [x] throws InvalidArgumentException if class not defined
     [x] throws InvalidArgumentException for everything else

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
