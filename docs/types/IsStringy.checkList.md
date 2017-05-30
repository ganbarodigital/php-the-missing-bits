# IsStringy::checkList()

{% include ".i/since/1.10.0.twig" %}


## Description

`IsStringy::checkList()` - can we use every item in a list as a string?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsStringy;
boolean IsStringy::checkList(mixed $list);
```

## Parameters

`IsStringy::check()` takes one parameter:

* `mixed $list` - the list to examine

## Return Value

`IsStringy::checkList()` returns a boolean:

* `true` if every entry in `$list` can be used as a PHP string (see [`IsStringy::check()`](IsStringy.check.html) for details)
* `false` otherwise

## Throws

`IsStringy::checkList()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList::check()`](IsList.check.html) for details)

{% include ".i/supports/5.6-7.x.twig" %}
