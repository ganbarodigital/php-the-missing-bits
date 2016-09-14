---
currentSection: classes-objects
currentItem: object-properties
pageflow_prev_url: HasObjectProperties.check.html
pageflow_prev_text: HasObjectProperties::check()
---

# IsObjectProperty::check()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsObjectProperty::check()` - is a [`ReflectionProperty`](http://www.php.net/ReflectionProperty) an object property?

```php
bool IsObjectProperty::check(ReflectionProperty $refProp);
```

## Parameters

`IsObjectProperty::check()` takes one parameter:

* `$refProp` ([ReflectionProperty](http://www.php.net/ReflectionProperty)) - the property to examine

## Return Value

`IsObjectProperty::check()` returns a boolean:

* `true` if `$refProp` is an object property,
* `false` otherwise.

## Throws

`IsObjectProperty::check()` does not throw any exceptions.
