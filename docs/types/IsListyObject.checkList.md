# IsListyObject::checkList()

{% include ".i/since/1.9.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsListyObject::checkList()` - is every item in the list an object that's a valid PHP list?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsListyObject;
bool IsListyObject::checkList(mixed $list);
```

## Parameters

`IsListyObject::checkList()` takes one parameter:

* `mixed $list` - the value to inspect

## Return Value

`IsListyObject::checkList()` returns a boolean:

* `true` if every value in `$list` is a [listy object](IsListyObject.check.html)
* `false` otherwise

## Throws

`IsListyObject::checkList()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList::check()`](IsList.check.html) for details)

{% include ".i/supports/5.6-7.x.twig" %}
