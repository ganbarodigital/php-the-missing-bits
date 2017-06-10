# IsList::checkList()

{% include ".i/since/1.9.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`IsList::checkList()` - is every item in the list a valid PHP list?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsList;
bool IsList::checkList(mixed $list);
```

## Parameters

`IsList::checkList()` takes one parameter:

* `mixed $list` - the value to inspect

## Return Value

`IsList::checkList()` returns a boolean:

* `true` if every value in `$list` is a valid PHP list
* `false` otherwise

## Throws

`IsList::checkList()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList::check()`](IsList.check.html) for details)

{% include ".i/supports/5.6-7.x.twig" %}
