# HasClassProperties::check()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`HasClassProperties::check()` - does a class have static properties?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

// our method signature
HasClassProperties::check(
    string $target,
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : bool
```

## Parameters

`HasClassProperties::check()` takes two parameters:

* `$target` (string) - the class to examine
* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

## Return Values

`HasClassProperties::check()` returns a boolean:

* `true` if `$target` is a class with 1 or more static properties that match `$propTypes`
* `false` otherwise

## Throws

`HasClassProperties::check()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

Here's a simple class to examine:

{% include ".i/examples/HasClassProperties/check/ExampleClass.inc.twig" %}

{% include ".i/examples/HasClassProperties/check/Example-1--Has-Public-Properties.twig" %}
{% include ".i/examples/HasClassProperties/check/Example-2--Has-Protected-Properties.twig" %}
{% include ".i/examples/HasClassProperties/check/Example-3--Has-Private-Properties.twig" %}

## Notes

* `HasClassProperties::check()` will also check parent classes and all the traits used by this class for static properties.
* `HasClassProperties::check()` only works on classes. Use [`HasObjectProperties::check()`](HasObjectProperties.html) to check an object for non-static properties.

{% include ".i/contracts/GanbaroDigital/MissingBits/ClassesAndObjects/HasClassProperties.twig" %}
{% include ".i/supports/5.6-7.x.twig" %}
