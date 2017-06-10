# IsClassProperty::using()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/code-metrics/GanbaroDigital/MissingBits/ClassesAndObjects/IsClassProperty.using.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsClassProperty::using()` - create a new instance of `IsClassProperty`.

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

// our method signature
public static IsClassProperty::using(
    ReflectionProperty $refProp
) : IsClassProperty
```

## Parameters

`IsClassProperty::using()` takes no parameters.

## Return Value

`IsClassProperty::using()` returns a new `IsClassProperty` object, ready to use.

## Throws

`IsClassProperty::using()` does not throw any exceptions.

## Examples

Here's a simple class to examine:

{% include ".i/examples/IsClassProperty/using/ExampleClass.inc.twig" %}

{% include ".i/examples/IsClassProperty/using/Example-1--Shorthand-Notation.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}
