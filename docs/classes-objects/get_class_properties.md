# get_class_properties()

{% include ".i/since/1.10.0.twig" %}

## Description

`get_class_properties()` - get a class's static properties

```php
get_class_properties(
    string $target,
    int $propTypes = ReflectionProperty::IS_PUBLIC
) : array
```

## Parameters

`get_class_properties()` takes two parameters:

* `$target` (string) - the class name to examine
* `$propTypes` (int) - optional scope filter

  `$propTypes` can be any of:

  - `ReflectionProperty::IS_PUBLIC`
  - `ReflectionProperty::IS_PROTECTED`
  - `ReflectionProperty::IS_PRIVATE`

  You can logical-OR them together to fetch (for example) both public and protected properties at the same time.

## Return Values

`get_class_properties()` returns an array of name / value pairs.

If the class has no static properties, `get_class_properties()` returns an empty array.

## Throws

`get_class_properties()` throws an `InvalidArgumentException` if:

* `$target` is not a string, or something that PHP will automatically convert to a string,
* `$target` refers to a class that has not been defined

## Examples

Here's a simple class to examine:

{% include ".i/examples/get_class_properties/ExampleClass.inc.twig" %}

{% include ".i/examples/get_class_properties/Example-1--Get-Public-Properties.twig" %}
{% include ".i/examples/get_class_properties/Example-2--Get-Protected-Properties.twig" %}
{% include ".i/examples/get_class_properties/Example-3--Get-Private-Properties.twig" %}

## Functional Contract

Here is the contract for this function:

    get_class_properties
     [x] returns empty array if class has no static properties
     [x] returns list of static public properties
     [x] returns list of static protected properties
     [x] returns list of static private properties
     [x] returns list of static public and protected properties
     [x] returns list of static public and private properties
     [x] returns list of static protected and private properties
     [x] returns list of static public protected and private properties
     [x] returned list includes parent classes static properties
     [x] returned list includes traits static properties
     [x] returned list includes parent classes and traits static properties
     [x] throws InvalidArgumentException for non strings
     [x] throws InvalidArgumentException if target is not valid classname

{% include ".i/boilerplate/function-contract.twig" %}

## Notes

* `get_class_properties()` will include all static properties defined by the class's parents, by any traits used by the class or its parents, and by any traits used by those traits.
* `get_class_properties()` only works on classes. Use [`get_object_properties()`](get_object_properties.html) to check for non-static properties.
* Discovered properties can be returned in any order.
* `get_class_properties()` is a convenience wrapper around [`FilterClassProperties::from()`](FilterClassProperties.from.html)

{% include ".i/supports/5.6-7.x.twig" %}
