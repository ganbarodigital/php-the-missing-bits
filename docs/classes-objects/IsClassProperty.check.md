---
currentSection: classes-objects
currentItem: class-properties
pageflow_prev_url: HasClassProperties.check.html
pageflow_prev_text: HasClassProperties::check()
---

# IsClassProperty::check()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsClassProperty::check()` - is a [`ReflectionProperty`](http://www.php.net/ReflectionProperty) a class property?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

// our method signature
bool IsClassProperty::check(ReflectionProperty $refProp);
```

## Parameters

`IsClassProperty::check()` takes one parameter:

* `$refProp` ([ReflectionProperty](http://www.php.net/ReflectionProperty)) - the property to examine

## Return Value

`IsClassProperty::check()` returns a boolean:

* `true` if `$refProp` is a class property,
* `false` otherwise.

## Throws

`IsClassProperty::check()` does not throw any exceptions.
