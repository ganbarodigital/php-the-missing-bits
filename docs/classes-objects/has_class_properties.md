---
currentSection: classes-objects
currentItem: class-properties
pageflow_prev_url: get_class_properties.html
pageflow_prev_text: get_class_properties()
pageflow_next_url: FilterClassProperties.from.html
pageflow_next_text: FilterClassProperties::from()
---

# has_class_properties()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`has_class_properties()` - does a class have static properties?

```php
bool has_class_properties(string $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`has_class_properties()` takes two parameters:

* `$target` (string) - the class to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`has_class_properties()` returns a boolean:

* `true` if `$target` is a class with 1 or more static properties that match `$propTypes`
* `false` otherwise

## Throws

`has_class_properties()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Notes

* `has_class_properties()` will also check parent classes and all the traits used by this class for static properties.
* `has_class_properties()` only works on classes. Use `has_object_properties()` to check for non-static properties.
* `has_class_properties()` is a convenience wrapper around [`HasClassProperties::check()`](HasClassProperties.check.html)
