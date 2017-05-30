# array_append_values()

{% include ".i/since/1.7.0.twig" %}

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

## Examples

{% include ".i/examples/array_append_values/Example-1--Append-To-List.twig" %}
{% include ".i/examples/array_append_values/Example-2--Append-To-Associative-Array.twig" %}

## Supported PHP Versions

PHP Version | Supported?
------------|-----------
5.6.x | yes
7.0.x | yes
7.1.x | yes