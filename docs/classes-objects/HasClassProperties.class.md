# HasClassProperties class

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

Use `HasClassProperties` to check if a class has static properties.

## Public Interface

`HasClassProperties` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\ClassesAndObjects;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\Checks\ListCheckHelper;
use InvalidArgumentException;
use ReflectionProperty;

/**
 * does a class have static properties?
 */
class HasClassProperties implements Check, ListCheck
{
    // save us having to implement it ourselves
    use ListCheckHelper;

    /**
     * create a customised HasClassProperties checker, ready to use
     *
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return HasClassProperties
     *         a customised Check, ready to use
     */
    public function __construct($propTypes = ReflectionProperty::IS_PUBLIC);

    /**
     * create a customised HasClassProperties checker, ready to use
     *
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return HasClassProperties
     *         a customised Check, ready to use
     */
    public static function using($propTypes = ReflectionProperty::IS_PUBLIC);

    /**
     * does a class have static properties?
     *
     * @param  string $target
     *         the class to examine
     * @return boolean
     *         TRUE if the class has static properties
     *         FALSE otherwise
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public function inspect($target);

    /**
     * does a list of class names have static properties?
     *
     * @param  mixed $list
     *         the list of data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public function inspectList($list);

    /**
     * does a class have static properties?
     *
     * @param  string $target
     *         the class to examine
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return boolean
     *         TRUE if the class has static properties
     *         FALSE otherwise
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public static function check($target, $propTypes = ReflectionProperty::IS_PUBLIC);

    /**
     * does a list of classes have static properties?
     *
     * @param  mixed $list
     *         the list of classes to examine
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return boolean
     *         TRUE if the class has static properties
     *         FALSE otherwise
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public static function checkList($list, $propTypes = ReflectionProperty::IS_PUBLIC);
}
```

## Methods

Method | Use
-------|----
[`HasClassProperties::check()`](HasClassProperties.check.html) | static
[`HasClassProperties::checkList()`](HasClassProperties.checkList.html) | static
[`HasClassProperties::using()`](HasClassProperties.using.html) | static
[`HasClassProperties::__construct()`](HasClassProperties.__construct.html) | object
[`HasClassProperties::inspect()`](HasClassProperties.inspect.html) | object
[`HasClassProperties::inspectList()`](HasClassProperties.inspectList.html) | object

{% include ".i/contracts/GanbaroDigital/MissingBits/ClassesAndObjects/HasClassProperties.twig" %}

## Notes

None at this time.

{% include ".i/supports/5.6-7.x.twig" %}
