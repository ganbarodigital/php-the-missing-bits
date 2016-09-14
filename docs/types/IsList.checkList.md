---
currentSection: types
currentItem: type-checks
pageflow_prev_url: IsList.check.html
pageflow_prev_text: IsList::check()
pageflow_next_url: IsListyObject.check.html
pageflow_next_text: IsListyObject::check()
---

# IsList::checkList()

<div class="callout info" markdown="1">
Since v1.9.0
</div>

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

## Works With

`IsList::checkList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
