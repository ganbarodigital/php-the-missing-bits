---
currentSection: lists
currentItem: TraverseArray
pageflow_prev_url: index.html
pageflow_prev_text: Lists
pageflow_next_url: TraverseList.html
pageflow_next_text: TraverseList class
---

# TraverseArray

<div class="callout info" markdown="1">
Since version 1.8.0
</div>

## Description

`TraverseArray::using()` - iterate over a PHP array

`traverse_array()` - global function that's a convenience wrapper around `TraverseArray::using()`

```php
// as static function
use GanbaroDigital\MissingBits\ListTraversals\TraverseArray;
void TraverseArray::using(array $list, string $listName, callable $callable);

// as a global function
void traverse_array(array $list, string $listName, callable $callable);
```

## Parameters

`TraverseArray::using()` takes three parameters:

* `array $list` - the list to iterate over
* `string $listName` - what you call `$list` in the calling code
* `callable $callable` - the function to call with each member of `$list`

`$callable` is any PHP `callable`. It should take three parameters:

```php
$callable = function($value, $key, $name) {
    // .. do something here
}
```

* `mixed $value` - a single entry from `$list`
* `mixed $key` - the array index of `$value`
* `string $name` - the human-readable name of `$value`, suitable for including in exception messages and logs

For example:

```php
$myList = [ "harry", "sally", "alice" ];
$callable = function($value, $key, $name) {
    echo "$name is $value" . PHP_EOL;
}
TraverseArray::using($myList, 'myList', $callable);
```

will output:

    $myList[0] is harry
    $myList[1] is sally
    $myList[2] is alice

## Return Value

`TraverseArray::using()` does not return a value.

## Throws

`TraverseArray::using()` throws an `InvalidArgumentException` if `$list` is not a PHP array.

<div class="callout info" markdown="1">
#### Why Don't We Use Type-Hinting Instead?

If we type-hinted `TraverseArray::using()` or `traverse_array()`, we'd end up triggering PHP's legacy error handling system when you passed a non-array to these functions.

We want to avoid PHP's legacy error handling system wherever we can. In our experience, it makes it very difficult to write robust software that fails gracefully.
</div>

## Works With

`TraverseArray::using()` and `traverse_array` are supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
