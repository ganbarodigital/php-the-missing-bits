---
currentSection: arrays
currentItem: array_append_values
pageflow_prev_url: index.html
pageflow_prev_text: Array Functions
pageflow_next_url: array_merge_keys.html
pageflow_next_text: array_merge_keys()
---

# array_append_values()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`array_append_values()` - fast alternative to PHP's built-in `array_merge()`

```php
array array_append_values(array $target, array $extra);
```

You'll need to experiment with your own application to work out when `array_append_values()` is faster than PHP's built-in `array_merge()`.

## Parameters

`array_append_values()` takes two parameters:

* `$target` (array) - the array that `$extra` will be appended to
* `$extra` (array) - the list of values to append to `$target`

It's a good idea to only call `array_append_values()` if both `$target` and `$extra` are non-associative arrays (i.e. they use numbered indexes, and the value of those numbers isn't important). You can pass associative arrays into `array_append_values()`, but you'll probably find the results very confusing!

## Return Values

`array_append_values()` returns a new array. This is the result of appending the values in `$extra` to `$target`.

* The keys and values from `$target` are maintained
* The values from `$extra` are appended
* The keys from `$extra` are ignored

## Example

```php
$target = [
    "fish" => "trout",
    "name" => "harry"
];

$extra = [
    "fish" => "salmon",
    "name" => "sally"
];

var_dump(array_append_values($target, $extra));
```

Outputs:

    array(4) {
      'fish' =>
      string(5) "trout"
      'name' =>
      string(5) "harry"
      [0] =>
      string(6) "salmon"
      [1] =>
      string(5) "sally"
    }
