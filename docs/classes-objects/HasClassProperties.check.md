---
currentSection: classes-objects
currentItem: class-properties
pageflow_prev_url: FilterClassProperties.from.html
pageflow_prev_text: FilterClassProperties::from()
pageflow_next_url: IsClassProperty.check.html
pageflow_next_text: IsClassProperty::check()
---

# HasClassProperties::check()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`HasClassProperties::check()` - does a class have static properties?

```php
bool HasClassProperties::check(string $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`HasClassProperties::check()` takes two parameters:

* `$target` (string) - the class to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`HasClassProperties::check()` returns a boolean:

* `true` if `$target` is a class with 1 or more static properties that match `$propTypes`
* `false` otherwise

## Throws

`HasClassProperties::check()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Notes

* `HasClassProperties::check()` will also check parent classes and all the traits used by this class for static properties.
* `HasClassProperties::check()` only works on classes. Use [`HasObjectProperties::check()`](HasObjectProperties.html) to check an object for non-static properties.
