# IsClassProperty::check()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/code-metrics/GanbaroDigital/MissingBits/ClassesAndObjects/IsClassProperty.check.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsClassProperty::check()` - is a [`ReflectionProperty`](http://www.php.net/ReflectionProperty) a class property?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

// our method signature
public static IsClassProperty::check(
    ReflectionProperty $refProp
) : bool
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

## Examples

Here's a simple class to examine:

{% include ".i/examples/IsClassProperty/check/ExampleClass.inc.twig" %}

{% include ".i/examples/IsClassProperty/check/Example-1--Check-For-Class-Property.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}
