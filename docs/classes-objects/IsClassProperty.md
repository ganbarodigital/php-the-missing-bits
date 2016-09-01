---
currentSection: classes-objects
currentItem: IsClassProperty
pageflow_prev_url: HasFilteredProperties.html
pageflow_prev_text: HasFilteredProperties class
pageflow_next_url: IsObjectProperty.html
pageflow_next_text: IsObjectProperty class
---

# IsClassProperty()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsClassProperty::check()` - is a [`ReflectionProperty`](http://www.php.net/ReflectionProperty) a class property?

```php
bool IsClassProperty::check(ReferenceObject $refProp);
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
