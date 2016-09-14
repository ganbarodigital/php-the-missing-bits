---
currentSection: types
currentItem: type-checks
pageflow_prev_url: IsArray.check.html
pageflow_prev_text: IsArray::check()
pageflow_next_url: IsAssignable.class.html
pageflow_next_text: IsAssignable class
---

# IsArray::checkList()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsArray::checkList()` - is every entry in the list a PHP array?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
bool IsArray::checkList(mixed $list);
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

* `$list` is not a valid list (see [`IsList::check()`](IsList.check.html) for details)

## Works With

`IsArray::checkList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
