# HasClassProperties::checkList()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`HasClassProperties::checkList()` - does a list of classes have static properties?

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;

// our method signature
public static HasClassProperties::checkList(
    mixed $list,
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : bool
```

## Parameters

`HasClassProperties::checkList()` takes two parameters:

* `$list` (mixed) - a list of classes to examine
* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

See [`IsList::check()`](../types/IsList.check.html) for details on what is a valid list.

## Return Values

`HasClassProperties::checkList()` returns a boolean:

* `true` if every class in `$list` is a class with 1 or more static properties that match the `$propTypes` you passed into the constructor
* `false` otherwise

## Throws

`HasClassProperties::checkList()` throws a `TypeError` if:

* `$list` is not a list we can iterate over, or
* any entry in the list is not a string, or something that PHP will automatically convert to a string,

`HasClassProperties::checkList()` throws an `InvalidArgumentException` if:
* any entry in the list refers to a class that has not been defined

## Examples

Here's some simple classes, that we're going to use `HasClassProperties` on:

{% include ".i/examples/HasClassProperties/checkList/ExampleClasses.inc.twig" %}

{% include ".i/examples/HasClassProperties/checkList/Example-1--Has-Public-Properties.twig" %}
{% include ".i/examples/HasClassProperties/checkList/Example-2--Has-Protected-Properties.twig" %}
{% include ".i/examples/HasClassProperties/checkList/Example-3--Has-Private-Properties.twig" %}

{% include ".i/examples/HasClassProperties/checkList/Example-4--Invalid-List.twig" %}
{% include ".i/examples/HasClassProperties/checkList/Example-5--List-With-Invalid-Contents.twig" %}
{% include ".i/examples/HasClassProperties/checkList/Example-6--Undefined-Classname.twig" %}

## Notes

* See the notes on [`HasClassProperties::check()`](HasClassProperties.check.html)

{% include ".i/supports/5.6-7.x.twig" %}
