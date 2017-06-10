# IsList::check()

{% include ".i/since/1.9.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsList::check()` - do we have a valid PHP list?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsList;
bool IsList::check(mixed $list);
```

## Parameters

`IsList::check()` takes one parameter:

* `mixed $list` - the value to inspect

## Return Value

`IsList::check()` returns a boolean:

PHP Type | Returns
---------|--------
array    | true
`Closure` object | false
any other object | true
anything else | false

## Throws

`IsList::check()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
