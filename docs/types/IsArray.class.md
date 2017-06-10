# IsArray class

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

Use `IsArray` to check if something can be used with PHP's built-in `array_xxx()` functions.

## Public Interface

`IsArray` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\TypeChecks;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;

/**
 * do we have something that is an array? It must be something that can be
 * used by any of PHP's array_xxx() functions
 */
class IsArray implements Check, ListCheck
{
    /**
     * do we have something that is an array?
     *
     * by array, we mean something that you can pass to any of PHP's
     * array_xxx() functions
     *
     * @param  mixed $fieldOrVar
     *         the item to be checked
     * @return bool
     *         TRUE if the item is an array
     *         FALSE otherwise
     */
    public static function check($fieldOrVar);

    /**
     * do we have something that is an array?
     *
     * by array, we mean something that you can pass to any of PHP's
     * array_xxx() functions
     *
     * @param  mixed $fieldOrVar
     *         the item to be checked
     * @return bool
     *         TRUE if the item is an array
     *         FALSE otherwise
     */
    public function inspect($fieldOrVar);

    /**
     * is every entry in $list an array?
     *
     * by array, we mean something that you can pass to any of PHP's
     * array_xxx() functions
     *
     * @param  mixed $list
     *         the list of items to be checked
     * @return bool
     *         TRUE if every item in $list is an array
     *         FALSE otherwise
     */
    public static function checkList($list);

    /**
     * does a list of values pass inspection?
     *
     * @param  mixed $list
     *         the list of data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public function inspectList($list);
}
```

## Methods

Method | Use
-------|----
[`IsArray::check()`](IsArray.check.html) | static
[`IsArray::checkList()`](IsArray.checkList.html) | static
[`IsArray::inspect()`](IsArray.inspect.html) | object
[`IsArray::inspectList()`](IsArray.inspectList.html) | object

## Interfaces

`IsArray` implements the following interfaces:

Interface | Purpose
----------|--------
[`Check`](../checks/Check.class.md) | `true` / `false` inspection of a single data item
[`ListCheck`](../checks/ListCheck.class.md) | `true` / `false` inspection of a list of data items

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\TypeChecks\IsArray
     [x] can instantiate
     [x] returns TRUE for array
     [x] returns FALSE for IteratorAggregate
     [x] returns FALSE for ArrayIterator
     [x] returns FALSE for ArrayObject
     [x] returns FALSE for stdClass
     [x] returns FALSE for everything else
     [x] is Check
     [x] can use as Check
     [x] is ListCheck
     [x] can use as ListCheck

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
