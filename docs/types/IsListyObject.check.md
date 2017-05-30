# IsListyObject::check()

{% include ".i/since/1.9.0.twig" %}

## Description

`IsListyObject::check()` - do we have an object that's a valid PHP list?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsListyObject;
bool IsListyObject::check(mixed $list);
```

## Parameters

`IsListyObject::check()` takes one parameter:

* `mixed $list` - the value to inspect

## Return Value

`IsListyObject::check()` returns a boolean:

PHP Type | Returns
---------|--------
`Closure` object | false
any other object | true
anything else | false

## Throws

`IsListyObject::check()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
