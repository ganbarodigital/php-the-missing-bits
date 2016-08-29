---
currentSection: classes-objects
currentItem: has_object_props
pageflow_prev_url: has_class_props.html
pageflow_prev_text: has_class_props()
---

# has_object_props()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`has_object_props()` - does an object have non-static properties?

```php
bool has_object_props(object $target, $filter = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`has_object_props()` takes two parameters:

* `$target` (object) - the object to examine
* `$filter` (int) - optional scope filter

## Return Values

`has_object_props()` returns a boolean:

* `true` if `$target` is an object with 1 or more properties that match `$filter`
* `false` otherwise

## Throws

`has_object_props()` does not throw any exceptions.

## Constraints

`has_object_props()` only works on objects. Use [`has_class_props()`](has_class_props.html) to check for static properties.
