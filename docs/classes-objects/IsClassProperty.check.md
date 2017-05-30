# IsClassProperty::check()

{% include ".i/since/1.10.0.twig" %}

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

{% include ".i/supports/5.6-7.x.twig" %}
