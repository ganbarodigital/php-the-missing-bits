# IsArray::checkList()

{% include ".i/since/1.10.0.twig" %}

## Description

`IsArray::checkList()` - is every entry in the list a PHP array?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
public static bool IsArray::checkList(mixed $list);
```

## Parameters

`IsArray::checkList()` takes one parameter:

* `mixed $list` - the list of values to inspect

## Return Value

`IsArray::checkList()` returns a boolean:

* `true` if every entry in `$list` can be used as a PHP array
* `false` otherwise

## Throws

`IsArray::checkList()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList`](IsList.class.html) for details)

## Works With

`IsArray::checkList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
