---
currentSection: types
currentItem: IsList
pageflow_prev_url: GetStringTypes.html
pageflow_prev_text: GetStringTypes class
pageflow_next_url: IsListyObject.html
pageflow_next_text: IsListyObject class
---

# IsList

<div class="callout info" markdown="1">
Since v1.9.0
</div>

## Description

`IsList::check()` - do we have a valid PHP list?

`is_list()` - global function that's a convenience wrapper around `IsList::check()`

```php
// as static function
use GanbaroDigital\MissingBits\TypeInspectors\IsList;
bool IsList::check(mixed $list, string $listName);

// as a global function
bool is_list(mixed $list, string $listName);
```

## Parameters

`IsList::check()` takes two parameters:

* `mixed $list` - the value to inspect
* `string $listName` - what you call `$list` in the calling code

## Return Value

`IsList::check()` returns a boolean:

PHP Type | Returns
---------|--------
array    | true
`Closure` object | false
any other object | true
anything else | false

## Throws

`IsList::check()` does not throw any exceptions.

## Works With

`IsList::check()` and `is_list()` are supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes