---
currentSection: lists
currentItem: list-iterators
pageflow_prev_url: TraverseArray.using.html
pageflow_prev_text: TraverseArray::using()
pageflow_next_url: TraverseObject.using.html
pageflow_next_text: TraverseObject::using()
---

# TraverseList::using()

<div class="callout info" markdown="1">
Since v1.8.0
</div>

## Description

`TraverseList::using()` - iterate over a PHP list (array, `Traversable` object, or object with public properties)

<div class="callout info" markdown="1">
`TraverseList::using()` is a convenience wrapper that accepts any recognised PHP list type. Underneath, it calls `TraverseArray::using()` or `TraverseObject::using()` as appropriate.

If you're writing a reusable PHP library or component, use `TraverseList::using()` so that your component is as reusable as possible.
</div>

```php
use GanbaroDigital\MissingBits\ListTraversals\TraverseList;
void TraverseList::using(mixed $list, string $listName, callable $callable);
```

## Parameters

`TraverseList::using()` takes three parameters:

* `mixed $list` - the list to iterate over
* `string $listName` - what you call `$list` in the calling code
* `callable $callable` - the function to call with each member of `$list`

`$list` can be any of the following:

Type | Behaviour
-----|----------
PHP array | passed to [`TraverseArray::using()`](TraverseArray.using.html)
object that implements `Traversable` | passed to [`TraverseArray::using()`](TraverseArray.using.html)
any other PHP object | passed to [`TraverseObject::using()`](TraverseObject.using.html)
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
