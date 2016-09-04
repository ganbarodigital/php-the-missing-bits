---
currentSection: types
currentItem: IsArray
pageflow_prev_url: GetStringTypes.html
pageflow_prev_text: GetStringTypes class
pageflow_next_url: IsAssignable.html
pageflow_next_text: IsAssignable class
---

# IsArray

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsArray::check()` - can a variable be used as a PHP array?

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
bool IsArray::check(mixed $fieldOrVar);
```

## Parameters

`IsArray::check()` takes one parameter:

* `mixed $fieldOrVar` - the value to inspect

## Return Value

`IsArray::check()` returns a boolean:

* `true` if `$fieldOrVar` can be used as a PHP array
* `false` otherwise

## Throws

`IsArray::check()` does not throw any exceptions.

## Works With

`IsArray::check()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
