# FilterClassProperties::using()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/code-metrics/GanbaroDigital/MissingBits/ClassesAndObjects/FilterClassProperties.using.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`FilterClassProperties::using()` - create a customised `FilterClassProperties` object, ready to use

```php
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;

public static FilterClassProperties::using(
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : FilterClassProperties
```

## Parameters

`FilterClassProperties::using()` takes one parameter:

* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

  You can logical-OR them together to fetch (for example) both public and protected properties at the same time.

## Return Values

`FilterClassProperties::using()` returns a customised `FilterClassProperties` object.

You can use this object to test multiple objects against the `$propTypes` you passed into `FilterClassProperties::using()`.

## Throws

`FilterClassProperties::using()` does not throw any exceptions.

## Examples

Here's a simple class to examine:

{% include ".i/examples/FilterClassProperties/using/ExampleClass.inc.twig" %}

{% include ".i/examples/FilterClassProperties/using/Example-1--Create-Reusable-Filter.twig" %}

## Notes

* See the notes on [`FilterClassProperties::from()`](FilterObjectProperties.from.html)

{% include ".i/supports/5.6-7.x.twig" %}
