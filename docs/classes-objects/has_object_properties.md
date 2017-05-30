# has_object_properties()

{% include ".i/since/1.10.0.twig" %}

## Description

`has_object_properties()` - does an object have non-static properties?

```php
bool has_object_properties(object $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`has_object_properties()` takes two parameters:

* `$target` (object) - the object to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`has_object_properties()` returns a boolean:

* `true` if `$target` is an object with 1 or more properties that match `$propTypes`
* `false` otherwise

## Throws

`has_object_properties()` throws an `InvalidArgumentException` if:

* `$target` is not an object

## Constraints

`has_object_properties()` only works on objects. Use [`has_class_properties()`](has_class_properties.html) to check for static properties.

## Notes

* `has_object_properties()` is a convenience wrapper around [`HasObjectProperties::check()`](HasObjectProperties.check.html)

{% include ".i/supports/5.6-7.x.twig" %}
