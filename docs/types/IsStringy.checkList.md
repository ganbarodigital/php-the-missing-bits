---
currentSection: types
currentItem: type-checks
pageflow_prev_url: IsStringy.check.html
pageflow_prev_text: IsStringy::check()
---

# IsStringy::checkList()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

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

## Works With

`IsStringy::checkList()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
