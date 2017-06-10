# IsClassProperty::__construct()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsClassProperty::__construct()` - create a new instance of `IsClassProperty`.

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

// our method signature
public IsClassProperty::__construct(
    ReflectionProperty $refProp
) : IsClassProperty
```

## Parameters

`IsClassProperty::__construct()` takes no parameters.

## Return Value

`IsClassProperty::__construct()` returns a new `IsClassProperty` object, ready to use.

## Throws

`IsClassProperty::__construct()` does not throw any exceptions.

## Examples

Here's a simple class to examine:

{% include ".i/examples/IsClassProperty/__construct/ExampleClass.inc.twig" %}

{% include ".i/examples/IsClassProperty/__construct/Example-1--Check-For-Class-Property.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}
