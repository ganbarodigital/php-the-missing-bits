---
currentSection: types
currentItem: IsArray
pageflow_prev_url: IsArray.html
pageflow_prev_text: IsArray class
pageflow_next_url: IsAssignable.html
pageflow_next_text: IsAssignable class
---

# is_array_list()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`is_array_list()` - is every entry in the list a PHP array?

```php
bool is_array_list(mixed $list);
```

## Parameters

`is_array_list()` takes one parameter:

* `mixed $list` - the list of values to inspect

## Return Value

`is_array_list()` returns a boolean:

* `true` if every entry in `$list` can be used as a PHP array
* `false` otherwise

## Throws

`is_array_list()` throws an `InvalidArgumentException` if:

* `$list` is not a valid list (see [`IsList`](IsList.html) for details)

## Works With

`is_array_list()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
