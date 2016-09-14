---
currentSection: types
currentItem: type-checks
pageflow_prev_url: IsListyObject.check.html
pageflow_prev_text: IsListyObject::check()
pageflow_next_url: IsStringy.check.html
pageflow_next_text: IsStringy::check()
---

# IsListyObject::checkList()

<div class="callout info" markdown="1">
Since v1.9.0
</div>

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

## Works With

`IsListyObject::checkList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
