# get_class_properties()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`get_class_properties()` - get a class's static properties

```php
array get_class_properties(string $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`get_class_properties()` takes two parameters:

* `$target` (string) - the class name to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`get_class_properties()` returns an array of name / value pairs.

If the class has no static properties, `get_class_properties()` returns an empty array.

## Throws

`get_class_properties()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Notes

* `get_class_properties()` will include all static properties defined by the class's parents, by any traits used by the class or its parents, and by any traits used by those traits.
* `get_class_properties()` only works on classes. Use [`get_object_properties()`](get_object_properties.html) to check for non-static properties.
* `get_class_properties()` is a convenience wrapper around [`FilterClassProperties::from()`](FilterClassProperties.from.html)
