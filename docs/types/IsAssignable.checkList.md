# IsAssignable::checkList()

{% include ".i/since/1.10.0.twig" %}

## Description

`IsAssignable::checkList()` - can every item in a list be used with PHP's object-assignment -> notation?

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsAssignable;
bool IsAssignable::checkList(mixed $list);
```

## Parameters

`IsAssignable::checkList()` takes one parameter:

* `mixed $list` - the list to inspect

## Return Value

`IsAssignable::checkList()` returns a boolean:

* `true` if every entry in `$list` can be used with PHP's object-assignment notation
* `false` otherwise

## Throws

`IsAssignable::checkList()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList::check()`](IsList.check.html) for details)

## Works With

`IsAssignable::checkList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
