---
currentSection: classes-objects
currentItem: has_class_props
pageflow_prev_url: get_class_props.html
pageflow_prev_text: get_class_props()
pageflow_next_url: has_object_props.html
pageflow_next_text: has_object_props()
---

# has_class_props()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`has_class_props()` - does a class have static properties?

```php
bool has_class_props(string $target, $filter = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`has_class_props()` takes two parameters:

* `$target` (string) - the class to examine
* `$filter` (int) - optional scope filter

## Return Values

`has_class_props()` returns a boolean:

* `true` if `$target` is a class with 1 or more static properties that match `$filter`
* `false` otherwise

## Throws

`has_class_props()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Constraints

`has_class_props()` only works on classes. Use `has_object_props()` to check for non-static properties.
