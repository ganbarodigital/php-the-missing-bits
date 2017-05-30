# has_class_properties()

{% include ".i/since/1.10.0.twig" %}

## Description

`has_class_properties()` - does a class have static properties?

```php
has_class_properties(
    string $target,
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : bool
```

## Parameters

`has_class_properties()` takes two parameters:

* `$target` (string) - the class to examine
* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

  You can logical-OR them together to check for (for example) both public and protected properties at the same time.

## Return Values

`has_class_properties()` returns a boolean:

* `true` if `$target` is a class with 1 or more static properties that match `$propTypes`
* `false` otherwise

## Throws

`has_class_properties()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Examples

Here's a simple class to examine:

{% include ".i/examples/has_class_properties/ExampleClass.inc.twig" %}

{% include ".i/examples/has_class_properties/Example-1--Has-Public-Properties.twig" %}
{% include ".i/examples/has_class_properties/Example-2--Has-Protected-Properties.twig" %}
{% include ".i/examples/has_class_properties/Example-3--Has-Private-Properties.twig" %}

## Notes

* `has_class_properties()` will also check parent classes and all the traits used by this class for static properties.
* `has_class_properties()` only works on classes. Use `has_object_properties()` to check for non-static properties.
* `has_class_properties()` is a convenience wrapper around [`HasClassProperties::check()`](HasClassProperties.check.html)

## Supported PHP Versions

PHP Version | Supported?
------------|-----------
5.6.x | yes
7.0.x | yes
7.1.x | yes