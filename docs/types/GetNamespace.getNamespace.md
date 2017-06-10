# GetNamespace::getNamespace()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetNamespace::getNamespace()` returns a class or object's namespace.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;
public string GetNamespace::getNamespace(string|object $item);
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`GetNamespace::getNamespace()` returns a string. It contains the namespace that the class or object is defined in.

* if the class or object has a namespace, that namespace is returned
* if the class or object has no namespace, an empty string is returned

## Throws

`GetNamespace::getNamespace()` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

{% include ".i/supports/5.6-7.x.twig" %}
