# FilterClassProperties::from()

{% include ".i/since/1.10.0.twig" %}

## Description

`FilterClassProperties::from()` - get a class's static properties

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;

// our method signature
FilterClassProperties::from(
    string $target,
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : array
```

## Parameters

`FilterClassProperties::from()` takes two parameters:

* `$target` (string) - the class name to examine
* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

  You can logical-OR them together to fetch (for example) both public and protected properties at the same time.

## Return Values

`FilterClassProperties::from()` returns an array of name / value pairs.

If the class has no static properties, `FilterClassProperties::from()` returns an empty array.

## Throws

`FilterClassProperties::from()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Examples

Here's a simple class to examine:

{% include ".i/examples/FilterClassProperties/from/ExampleClass.inc.twig" %}

{% include ".i/examples/FilterClassProperties/from/Example-1--Get-Public-Properties.twig" %}
{% include ".i/examples/FilterClassProperties/from/Example-2--Get-Protected-Properties.twig" %}
{% include ".i/examples/FilterClassProperties/from/Example-3--Get-Private-Properties.twig" %}

## Notes

* `FilterClassProperties::from()` will include all static properties defined by the class's parents, by any traits used by the class or its parents, and by any traits used by those traits.
* `FilterClassProperties::from()` only works on classes. Use [`FilterObjectProperties::from()`](FilterObjectProperties.from.html) to get an object's non-static properties.
* Discovered properties can be returned in any order.

{% include ".i/contracts/GanbaroDigital/MissingBits/ClassesAndObjects/FilterClassProperties.twig" %}
{% include ".i/supports/5.6-7.x.twig" %}
