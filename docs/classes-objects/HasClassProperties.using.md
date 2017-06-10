# HasClassProperties::using()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`HasClassProperties::using()` - create a customised, reusable `HasClassProperties` check

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

// our method signature
public static HasClassProperties::using(
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : HasClassProperties
```

## Parameters

`HasClassProperties::using()` takes one parameter:

* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

## Return Values

`HasClassProperties::using()` returns a new instance of `HasClassProperties`. You can use this new object to check for the types of class properties you set in `$propTypes`.

## Throws

`HasClassProperties::using()` doesn't throw any exceptions.

## Examples

Here's a simple class to examine:

{% include ".i/examples/HasClassProperties/using/ExampleClass.inc.twig" %}

{% include ".i/examples/HasClassProperties/using/Example-1--Create-Reusable-Checker.twig" %}
{% include ".i/examples/HasClassProperties/using/Example-2--Shorthand-Notation.twig" %}


## Notes

* See the notes on [`HasClassProperties::check()`](HasClassProperties.check.html)

{% include ".i/supports/5.6-7.x.twig" %}
