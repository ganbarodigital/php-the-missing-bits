---
currentSection: classes-objects
currentItem: has_object_properties
pageflow_prev_url: has_class_properties.html
pageflow_prev_text: has_class_properties()
pageflow_next_url: FilterClassProperties.html
pageflow_next_text: FilterClassProperties class
---

# has_object_properties()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

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

* `has_object_properties()` is a convenience wrapper around [`HasObjectProperties::check()`](HasObjectProperties.html)
