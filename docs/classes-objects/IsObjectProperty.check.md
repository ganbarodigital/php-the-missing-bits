# IsObjectProperty::check()

{% include ".i/since/1.10.0.twig" %}

## Description

`IsObjectProperty::check()` - is a [`ReflectionProperty`](http://www.php.net/ReflectionProperty) an object property?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsObjectProperty;

// our method signature
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
