---
currentSection: classes-objects
currentItem: get_object_properties
pageflow_prev_url: get_class_properties.html
pageflow_prev_text: get_class_properties()
pageflow_next_url: has_class_properties.html
pageflow_next_text: has_class_properties()
---

# get_object_properties()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`get_object_properties()` - get an object's non-static properties

```php
array get_object_properties(object $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`get_object_properties()` takes two parameters:

* `$target` (object) - the object to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`get_object_properties()` returns an array of name / value pairs.

If the object has no non-static properties, `get_object_properties()` returns an empty array.

## Throws

`get_object_properties()` throws an `InvalidArgumentException` if:

* `$target` is not an object

## Notes

* `get_object_properties()` will include all non-static properties defined by the class's parents, by any traits used by the class or its parents, and by any traits used by those traits.
* `get_object_properties()` only works on objects. Use [`get_class_properties()`](get_class_properties.html) to check for static properties.
* `get_object_properties()` is a convenience wrapper around [`FilterObjectProperties::from()`](FilterObjectProperties.html)
