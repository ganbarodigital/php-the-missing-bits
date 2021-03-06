# IsStringy

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsStringy::check()` - can we use the variable as a string?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsStringy;
boolean IsStringy::check(mixed $item);
```

## Parameters

`IsStringy::check()` takes one parameter:

* `mixed $item` - the variable to examine

## Return Value

`IsStringy::check()` returns a boolean:

* `true` if PHP will use `$item` as a string
  - strings
  - integers
  - doubles
  - objects with the `__toString()` method
* `false` otherwise
  - null
  - arrays
  - booleans
  - resources
  - all other objects

## Throws

`IsStringy::check()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
