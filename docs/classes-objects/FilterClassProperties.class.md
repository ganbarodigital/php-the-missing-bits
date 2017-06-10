# FilterClassProperties class

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

Use `FilterClassProperties` to extract a list of static properties from a class.

## Public Interface

`FilterClassProperties` has the following public interface:

```php
namespace GanbaroDigital\MissingBits\ClassesAndObjects;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionProperty;

/**
 * get a class's static properties
 */
class FilterClassProperties
{
    /**
     * creates a new class properties filter, ready to use
     *
     * @param  int $filter
     *         the kind of properties to look for
     *         default is to look for public properties only
     */
    public function __construct($filter = ReflectionProperty::IS_PUBLIC);

    /**
     * creates a new class properties filter, ready to use
     *
     * @param  int $filter
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return FilterClassProperties
     *         a customised FilterClassProperties ready to use
     */
    public static function using($filter = ReflectionProperty::IS_PUBLIC);

    /**
     * get a class's static properties
     *
     * @param  string $target
     *         the class to examine
     * @return array
     *         a (possibly empty) read-only list of the class's static properties
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public function filterClassProperties($target);

    /**
     * get a class's static properties
     *
     * @param  string $target
     *         the class to examine
     * @param  int $filter
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return array
     *         a (possibly empty) read-only list of the class's static properties
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public static function from($target, $filter = ReflectionProperty::IS_PUBLIC);
    }
}
```

## Methods

Method | Use
-------|----
[`FilterClassProperties::from()`](FilterClassProperties.from.html) | static
[`FilterClassProperties::using()`](FilterClassProperties.using.html) | static
[`FilterClassProperties::__construct()`](FilterClassProperties.__construct.html) | object
[`FilterClassProperties::filterClassProperties()`](FilterClassProperties.filterClassProperties.html) | object

{% include ".i/contracts/GanbaroDigital/MissingBits/ClassesAndObjects/FilterClassProperties.twig" %}

## Notes

None at this time.

{% include ".i/supports/5.6-7.x.twig" %}
