# FilterObjectProperties::from()

{% include ".i/since/1.10.0.twig" %}

## Description

`FilterObjectProperties::from()` - get an object's non-static properties

```php
// remember to import first
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterObjectProperties;

// our method signature
array FilterObjectProperties::from(object $target, $propTypes = ReflectionProperty::IS_PUBLIC);
```

## Parameters

`FilterObjectProperties::from()` takes two parameters:

* `$target` (object) - the object to examine
* `$propTypes` (int) - optional scope filter

## Return Values

`FilterObjectProperties::from()` returns an array of name / value pairs.

If the object has no non-static properties, `FilterObjectProperties::from()` returns an empty array.

## Throws

`FilterObjectProperties::from()` throws an `InvalidArgumentException` if:

* `$target` is not an object

## Notes

* `FilterObjectProperties::from()` will include all non-static properties defined by the object's parents, by any traits used.
* `FilterObjectProperties::from()` only works on objects. Use [`FilterClassProperties::from()`](FilterClassProperties.from.html) to get a class's static properties.

{% include ".i/supports/5.6-7.x.twig" %}
