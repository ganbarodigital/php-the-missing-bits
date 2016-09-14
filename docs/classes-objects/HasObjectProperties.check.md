---
currentSection: classes-objects
currentItem: object-properties
pageflow_prev_url: FilterObjectProperties.from.html
pageflow_prev_text: FilterObjectProperties::from()
pageflow_next_url: IsObjectProperty.check.html
pageflow_next_text: IsObjectProperty::check()
---

# HasObjectProperties::check()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`HasObjectProperties::check()` - does an object have non-static properties?

```php
bool HasObjectProperties(object $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`HasObjectProperties::check()` takes two parameters:

* `$target` (object) - the object to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`HasObjectProperties::check()` returns a boolean:

* `true` if `$target` is an object with 1 or more properties that match `$propTypes`
* `false` otherwise

## Throws

`HasObjectProperties::check()` throws an `InvalidArgumentException` if:

* `$target` is not an object

## Constraints

`HasObjectProperties::check()` only works on objects. Use [`HasClassProperties::check()`](HasClassProperties.check.html) to check for static properties.
