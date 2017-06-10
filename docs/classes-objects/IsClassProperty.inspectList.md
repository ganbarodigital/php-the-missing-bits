# IsClassProperty::inspectList()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsClassProperty::inspectList()` - does the list of [`ReflectionProperty`](http://www.php.net/ReflectionProperty) entries only contain class properties?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

// our method signature
public IsClassProperty::inspectList(
    mixed $list
) : bool
```

## Parameters

`IsClassProperty::inspectList()` takes one parameter:

* `$list` (mixed) - a list of [ReflectionProperty](http://www.php.net/ReflectionProperty) entries to examine

See [`IsList::check()`](../types/IsList.check.html) for details on what is a valid list.

## Return Value

`IsClassProperty::inspectList()` returns a boolean:

* `true` if every entry in `$list` is a class property.
* `false` otherwise.

## Throws

`IsClassProperty::inspectList()` throws a `TypeError` if:

* `$list` is not a valid list, or
* any entry in `$list` is not a `ReflectionProperty`

## Examples

Here's a simple class to examine:

{% include ".i/examples/IsClassProperty/inspectList/ExampleClass.inc.twig" %}

{% include ".i/examples/IsClassProperty/inspectList/Example-1--Check-List-For-Class-Properties.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}
