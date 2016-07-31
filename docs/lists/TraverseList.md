---
currentSection: lists
currentItem: TraverseList
pageflow_prev_url: TraverseArray.html
pageflow_prev_text: TraverseArray class
pageflow_next_url: TraverseList.html
pageflow_next_text: TraverseList class
---

# TraverseList

<div class="callout info" markdown="1">
Since version 1.8.0
</div>

## Description

`TraverseList::using()` - iterate over a PHP list (array, `Traversable` object, or object with public properties)

`traverse_list()` - global function that's a convenience wrapper around `TraverseList::using()`

<div class="callout info" markdown="1">
`TraverseList::using()` is a convenience wrapper that accepts any recognised PHP list type. Underneath, it calls `TraverseArray::using()` or `TraverseObject::using()` as appropriate.

If you're writing a reusable PHP library or component, use `TraverseList::using()` so that your component is as reusable as possible.
</div>

```php
// as static function
use GanbaroDigital\MissingBits\ListTraversals\TraverseList;
void TraverseList::using(mixed $list, string $listName, callable $callable);

// as a global function
void traverse_list(mixed $list, string $listName, callable $callable);
```

## Parameters

`TraverseList::using()` takes three parameters:

* `mixed $list` - the list to iterate over
* `string $listName` - what you call `$list` in the calling code
* `callable $callable` - the function to call with each member of `$list`

`$list` can be any of the following:

Type | Behaviour
-----|----------
PHP array | passed to [`TraverseArray::using()`](TraverseArray.html)
object that implements `Traversable` | passed to [`TraverseArray::using()`](TraverseArray.html)
any other PHP object | passed to [`TraverseObject::using()`](TraverseObject.html)
anything else | `InvalidArgumentException` thrown

`$callable` is any PHP `callable`. It should take three parameters:

```php
$callable = function($value, $key, $name) {
    // .. do something here
}
```

* `mixed $value` - a single entry from `$list`
* `mixed $key` - the array index or object attribute of `$value`
* `string $name` - the human-readable name of `$value`, suitable for including in exception messages and logs

## Return Value

`TraverseList::using()` does not return a value.

## Throws

`TraverseList::using()` throws an `InvalidArgumentException` if `$list` is not a supported list type.

## Works With

`TraverseList::using()` and `traverse_list()` are supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
