---
currentSection: types
currentItem: is_stringy
pageflow_prev_url: GetStringTypes.html
pageflow_prev_text: GetStringTypes class
pageflow_next_url: StripNamespace.html
pageflow_next_text: StripNamespace class
---

# is_stringy()

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`is_stringy()` - can we use the variable as a string?

```php
boolean is_stringy(mixed $item);
```

## Parameters

`is_stringy()` takes one parameter:

* `mixed $item` - the variable to examine

## Return Value

`is_stringy()` returns `TRUE` or `FALSE`:

* `TRUE` if PHP will use `$item` as a string
  - strings
  - integers
  - doubles
  - objects with the `__toString()` method
* `FALSE` otherwise
  - null
  - arrays
  - booleans
  - resources
  - all other objects

## Throws

`is_stringy()` does not throw any exceptions.

## Works With

`is_stringy()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
