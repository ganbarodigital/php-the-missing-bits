---
currentSection: types
currentItem: IsStringy
pageflow_prev_url: IsListyObject.html
pageflow_prev_text: IsListyObject class
pageflow_next_url: StripNamespace.html
pageflow_next_text: StripNamespace class
---

# IsStringy

<div class="callout info" markdown="1">
* `is_stringy()` - since v1.8.0
* `IsStringy::check()` - since v1.10.0
</div>

## Description

`IsStringy::check()` - can we use the variable as a string?

`is_stringy()` - global function that's a convenience wrapper around `IsStringy::check()`

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsStringy;
boolean IsStringy::check(mixed $item);

// as global function
boolean is_stringy(mixed $item);
```

## Parameters

`IsStringy::check()` takes one parameter:

* `mixed $item` - the variable to examine

## Return Value

`IsStringy::check()` returns `TRUE` or `FALSE`:

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

`IsStringy::check()` does not throw any exceptions.

## Works With

`IsStringy::check()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
