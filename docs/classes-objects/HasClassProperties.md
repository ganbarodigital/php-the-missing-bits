---
currentSection: classes-objects
currentItem: HasClassProperties
pageflow_prev_url: FilterProperties.html
pageflow_prev_text: FilterProperties class
pageflow_next_url: HasFilteredProperties.html
pageflow_next_text: HasFilteredProperties class
---

# HasClassProperties

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
