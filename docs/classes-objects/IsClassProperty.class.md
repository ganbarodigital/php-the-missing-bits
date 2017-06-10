# IsClassProperty class

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

Use `IsClassProperty` to check if a class has static properties.

## Public Interface

`IsClassProperty` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\ClassesAndObjects;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\Checks\ListCheckHelper;
use InvalidArgumentException;
use ReflectionProperty;

/**
 * is this property a class property?
 */
class IsClassProperty implements Check, ListCheck
{
    /**
     * create a new instance
     */
    public function __construct();

    /**
     * create a customised IsClassProperty checker, ready to use
     *
     * @return IsClassProperty
     *         a Check, ready to use
     */
    public static function using();

    /**
     * is this property a class property?
     *
     * @param  ReflectionProperty $refProp
     *         the property to inspect
     * @return bool
     *         TRUE if $refProp is a class property
     *         FALSE otherwise
     */
    public static function inspect($refProp)

    /**
     * are all the properties in the list class properties?
     *
     * @param  mixed $list
     *         the list of properties to inspect
     * @return bool
     *         TRUE if all the entries in the list are class
     *         properties
     *         FALSE otherwise
     */
    public function inspectList($list);

    /**
     * is this property a class property?
     *
     * @param  ReflectionProperty $refProp
     *         the property to inspect
     * @return bool
     *         TRUE if $refProp is a class property
     *         FALSE otherwise
     */
    public static function check(ReflectionProperty $refProp);

    /**
     * are all the properties in the list class properties?
     *
     * @param  mixed $list
     *         the list of properties to inspect
     * @return bool
     *         TRUE if all the entries in the list are class
     *         properties
     *         FALSE otherwise
     */
    public static function checkList($list);
}
```

## Methods

Method | Use
-------|----
[`IsClassProperty::check()`](IsClassProperty.check.html) | static
[`IsClassProperty::checkList()`](IsClassProperty.checkList.html) | static
[`IsClassProperty::using()`](IsClassProperty.using.html) | static
[`IsClassProperty::__construct()`](IsClassProperty.__construct.html) | object
[`IsClassProperty::inspect()`](IsClassProperty.inspect.html) | object
[`IsClassProperty::inspectList()`](IsClassProperty.inspectList.html) | object

{% include ".i/contracts/GanbaroDigital/MissingBits/ClassesAndObjects/IsClassProperty.twig" %}

## Notes

None at this time.

{% include ".i/supports/5.6-7.x.twig" %}
