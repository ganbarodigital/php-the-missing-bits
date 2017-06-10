# IsClassProperty::checkList()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/code-metrics/GanbaroDigital/MissingBits/ClassesAndObjects/IsClassProperty.checkList.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsClassProperty::checkList()` - does the list of [`ReflectionProperty`](http://www.php.net/ReflectionProperty) entries only contain class properties?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;

// our method signature
public static IsClassProperty::checkList(
    mixed $list
) : bool
```

## Parameters

`IsClassProperty::checkList()` takes one parameter:

* `$list` (mixed) - a list of [ReflectionProperty](http://www.php.net/ReflectionProperty) entries to examine

See [`IsList::check()`](../types/IsList.check.html) for details on what is a valid list.

## Return Value

`IsClassProperty::checkList()` returns a boolean:

* `true` if every entry in `$list` is a class property.
* `false` otherwise.

## Throws

`IsClassProperty::checkList()` throws a `TypeError` if:

* `$list` is not a valid list, or
* any entry in `$list` is not a `ReflectionProperty`

## Examples

Here's a simple class to examine:

{% include ".i/examples/IsClassProperty/checkList/ExampleClass.inc.twig" %}

{% include ".i/examples/IsClassProperty/checkList/Example-1--Check-List-For-Class-Properties.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}
