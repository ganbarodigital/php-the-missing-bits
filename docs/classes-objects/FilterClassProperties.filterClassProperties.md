# FilterClassProperties::filterClassProperties()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/code-metrics/GanbaroDigital/MissingBits/ClassesAndObjects/FilterClassProperties.filterClassProperties.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`FilterClassProperties::filterClassProperties()` - get a class's static properties

```php
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;

public FilterClassProperties::filterClassProperties(
    string $target
) : FilterClassProperties
```

## Parameters

`FilterClassProperties::filterClassProperties()` takes one parameter:

* `$target` (string) - the class name to examine

## Return Values

`FilterClassProperties::filterClassProperties()` returns an array of name / value pairs.

If the class has no static properties, `FilterClassProperties::filterClassProperties()` returns an empty array.

## Throws

`FilterClassProperties::filterClassProperties()` throws a `TypeError` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,

`FilterClassProperties::filterClassProperties()` throws an `InvalidArgumentException` if:

* `$target` refers to a class that has not been defined

## Examples

Here's a simple class to examine:

{% include ".i/examples/FilterClassProperties/filterClassProperties/ExampleClass.inc.twig" %}

{% include ".i/examples/FilterClassProperties/filterClassProperties/Example-1--Get-Public-Properties.twig" %}
{% include ".i/examples/FilterClassProperties/filterClassProperties/Example-2--Get-Protected-Properties.twig" %}
{% include ".i/examples/FilterClassProperties/filterClassProperties/Example-3--Get-Private-Properties.twig" %}

## Notes

* See the notes on [`FilterClassProperties::from()`](FilterObjectProperties.from.html)

{% include ".i/supports/5.6-7.x.twig" %}
