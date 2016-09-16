# IsListyObject::check()

<div class="callout info" markdown="1">
Since v1.9.0
</div>

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

## Works With

`IsListyObject::check()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
