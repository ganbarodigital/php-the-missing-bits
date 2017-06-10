# strip_namespace()

{% include ".i/since/1.4.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`strip_namespace()` returns a class or object's class name, minus the namespace.

```php
public string strip_namespace(string|object $item);
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`strip_namespace()` returns a string. It contains the name of the class or object, without the namespace portion of the name.

## Throws

`strip_namespace()` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

{% include ".i/supports/5.6-7.x.twig" %}
