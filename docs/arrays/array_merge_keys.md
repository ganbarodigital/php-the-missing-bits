# array_merge_keys()

<div class="callout info" markdown="1">
Since version 1.7.0
</div>

## Description

`array_merge_keys()` - fast alternative to PHP's built-in `array_merge()`

```php
array array_merge_keys(array $target, array $extra);
```

You'll need to experiment with your own application to work out when `array_merge_keys()` is faster than PHP's built-in `array_merge()`.

## Parameters

`array_merge_keys()` takes two parameters:

* `$target` (array) - the array that `$extra` will be merged into
* `$extra` (array) - the list of values to merge into `$target`

It's a good idea to only call `array_merge_keys()` if both `$target` and `$extra` are associative arrays. Combining associative and non-associative arrays (i.e. arrays with numbered indexes) works, but you'll probably find the results very confusing!

## Return Values

`array_merge_keys()` returns a new array. This is the result of merging the keys in `$extra` into `$target`.

* `$extra` overwrites `$target` where the same key exists in both arrays
* otherwise, the values of unique keys from both arrays are added to the new array

## Examples

{% include ".i/examples/array_merge_keys/Example-1--Merge-Two-Arrays.twig" %}

## Supported PHP Versions

PHP Version | Supported?
------------|-----------
5.6.x | yes
7.0.x | yes
7.1.x | yes