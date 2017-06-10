# check_is_object_property()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`check_is_object_property()` - is a `ReflectionProperty` a property on an object?

```php
check_is_object_property(ReflectionProperty $refProp) : bool
```

`check_is_object_property()` is a convenience wrapper around [`IsObjectProperty::check()`](IsObjectProperty.check.html).

## Parameters

`check_is_object_property()` takes one parameter:

* `$refProp` (ReflectionProperty) - the property to examine

## Return Values

`check_is_object_property()` returns a boolean:

* `true` if `$refProp` is not a `static` property
* `false` otherwise

{% include ".i/contracts/check_is_object_property.twig" %}
{% include ".i/supports/5.6-7.x.twig" %}
