# HasClassProperties::inspect()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`HasClassProperties::inspect()` - does a class have static properties?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

// our method signature
public HasClassProperties::inspect(
    string $target
) : bool
```

## Parameters

`HasClassProperties::inspect()` takes one parameter:

* `$target` (string) - the class to examine

## Return Values

`HasClassProperties::inspect()` returns a boolean:

* `true` if `$target` is a class with 1 or more static properties that match whatever `$propTypes` you passed into the constructor
* `false` otherwise

## Throws

`HasClassProperties::inspect()` throws a `TypeError` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,

`HasClassProperties::inspect()` throws an `InvalidArgumentException` if:

* `$target` refers to a class that has not been defined

Here's a simple class to examine:

{% include ".i/examples/HasClassProperties/inspect/ExampleClass.inc.twig" %}

{% include ".i/examples/HasClassProperties/inspect/Example-1--Has-Public-Properties.twig" %}
{% include ".i/examples/HasClassProperties/inspect/Example-2--Has-Protected-Properties.twig" %}
{% include ".i/examples/HasClassProperties/inspect/Example-3--Has-Private-Properties.twig" %}

## Notes

* See the notes on [`HasClassProperties::check()`](HasClassProperties.check.html)

{% include ".i/supports/5.6-7.x.twig" %}
