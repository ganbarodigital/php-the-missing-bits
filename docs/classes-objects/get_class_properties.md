# get_class_properties()

{% include ".i/since/1.10.0.twig" %}

## Description

`get_class_properties()` - get a class's static properties

```php
get_class_properties(
    string $target,
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : array
```

## Parameters

`get_class_properties()` takes two parameters:

* `$target` (string) - the class name to examine
* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

  You can logical-OR them together to fetch (for example) both public and protected properties at the same time.

## Return Values

`get_class_properties()` returns an array of name / value pairs.

If the class has no static properties, `get_class_properties()` returns an empty array.

## Throws

`get_class_properties()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Examples

Here's a simple class to examine:

{% include ".i/examples/get_class_properties/ExampleClass.inc.twig" %}

{% include ".i/examples/get_class_properties/Example-1--Get-Public-Properties.twig" %}
{% include ".i/examples/get_class_properties/Example-2--Get-Protected-Properties.twig" %}
{% include ".i/examples/get_class_properties/Example-3--Get-Private-Properties.twig" %}

## Notes

* `get_class_properties()` will include all static properties defined by the class's parents, by any traits used by the class or its parents, and by any traits used by those traits.
* `get_class_properties()` only works on classes. Use [`get_object_properties()`](get_object_properties.html) to check for non-static properties.
* Discovered properties can be returned in any order.
* `get_class_properties()` is a convenience wrapper around [`FilterClassProperties::from()`](FilterClassProperties.from.html)

## Supported PHP Versions

PHP Version | Supported?
------------|-----------
5.6.x | yes
7.0.x | yes
7.1.x | yes