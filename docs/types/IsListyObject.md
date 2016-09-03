---
currentSection: types
currentItem: IsListyObject
pageflow_prev_url: IsList.html
pageflow_prev_text: IsList class
pageflow_next_url: IsStringy.html
pageflow_next_text: IsStringy class
---

# IsListyObject

<div class="callout info" markdown="1">
Since v1.9.0
</div>

## Description

`IsListyObject::check()` - do we have an object that's a valid PHP list?

`is_listy_object()` - global function that's a convenience wrapper around `IsListyObject::check()`

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsListyObject;
bool IsListyObject::check(mixed $list, string $listName);

// as a global function
bool is_listy_object(mixed $list, string $listName);
```

## Parameters

`IsListyObject::check()` takes two parameters:

* `mixed $list` - the value to inspect
* `string $listName` - what you call `$list` in the calling code

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

`IsListyObject::check()` and `is_listy_object()` are supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
