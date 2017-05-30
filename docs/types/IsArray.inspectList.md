# IsArray::inspectList()

{% include ".i/since/1.10.0.twig" %}

## Description

`IsArray::inspectList()` - is every entry in the list a PHP array?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
public bool IsArray::inspectList(mixed $list);
```

## Parameters

`IsArray::inspectList()` takes one parameter:

* `mixed $list` - the list of values to inspect

## Return Value

`IsArray::inspectList()` returns a boolean:

* `true` if every entry in `$list` can be used as a PHP array
* `false` otherwise

## Throws

`IsArray::inspectList()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList`](IsList.class.html) for details)

## Works With

`IsArray::inspectList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
