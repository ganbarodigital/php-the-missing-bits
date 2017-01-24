# StripNamespace

<div class="callout info">
Since v1.4.0
</div>

## Description

`StripNamespace` returns a class or object's class name, minus the namespace.

## Public Interface

`IsArray` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeInspectors;

use InvalidArgumentException;

/**
 * get the name of a class, minus its namespace
 */
class StripNamespace
{
    /**
     * get the name of a class, minus its namespace
     *
     * @param  string|object $item
     *         the item to examine
     * @return string
     *         the class's non-qualified classname
     * @throws InvalidArgumentException
     *         - if we have not been given a string or object
     *         - if the string does not contain the name of a defined
     *           class / interface / trait
     */
    public function stripNamespace($item);

    /**
     * get the name of a class, minus its namespace
     *
     * @param  string|object $item
     *         the item to examine
     * @return string
     *         the class's non-qualified classname
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
[`StripNamespace::from()`](StripNamespace.from.html) | static
[`StripNamespace::stripNamespace()`](StripNamespace.stripNamespace.html) | object

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeInspectors\StripNamespace
     [x] Can instantiate
     [x] Can use as object
     [x] Can call statically
     [x] Can call as function
     [x] Strips namespaces from classes
     [x] Strips namespaces from objects
     [x] Returns class name for classes with no namespace
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
