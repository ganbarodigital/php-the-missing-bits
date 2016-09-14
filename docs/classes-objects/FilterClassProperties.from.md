---
currentSection: classes-objects
currentItem: class-properties
pageflow_prev_url: has_class_properties.html
pageflow_prev_text: has_class_properties()
pageflow_next_url: HasClassProperties.check.html
pageflow_next_text: HasClassProperties::check()
---

# FilterClassProperties::from()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`FilterClassProperties::from()` - get a class's static properties

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;

// our method signature
array FilterClassProperties::from(string $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`FilterClassProperties::from()` takes two parameters:

* `$target` (string) - the class name to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`FilterClassProperties::from()` returns an array of name / value pairs.

If the class has no static properties, `FilterClassProperties::from()` returns an empty array.

## Throws

`FilterClassProperties::from()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Notes

* `FilterClassProperties::from()` will include all static properties defined by the class's parents, by any traits used by the class or its parents, and by any traits used by those traits.
* `FilterClassProperties::from()` only works on classes. Use [`FilterObjectProperties::from()`](FilterObjectProperties.from.html) to get an object's non-static properties.
