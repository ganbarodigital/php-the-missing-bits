# TraverseArray::using()

{% include ".i/since/1.8.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`TraverseArray::using()` - iterate over a PHP array

```php
use GanbaroDigital\MissingBits\ListTraversals\TraverseArray;
void TraverseArray::using(array $list, string $listName, callable $callable);
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

{% include ".i/supports/5.6-7.x.twig" %}
