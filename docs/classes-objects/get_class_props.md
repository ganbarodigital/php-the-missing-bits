---
currentSection: classes-objects
currentItem: get_class_props
pageflow_prev_url: index.html
pageflow_prev_text: Class and Object Functions
pageflow_next_url: has_class_props.html
pageflow_next_text: has_class_props()
---

# get_class_props()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`get_class_props()` - get a class's static properties

```php
array get_class_props(string $target, $filter = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`get_class_props()` takes two parameters:

* `$target` (string) - the class name to examine
* `$filter` (int) - optional scope filter

## Return Values

`get_class_props()` returns an array of name / value pairs.

If the class has no static properties, `get_class_props()` returns an empty array.

## Throws

`get_class_props()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Constraints

`get_class_props()` only works on classes. Use PHP's built-in `get_object_props()` to check for non-static properties.
