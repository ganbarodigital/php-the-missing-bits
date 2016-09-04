---
currentSection: types
currentItem: IsAssignable
pageflow_prev_url: is_array_list.html
pageflow_prev_text: is_array_list()
pageflow_next_url: IsList.html
pageflow_next_text: IsList class
---

# IsAssignable

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsAssignable::check()` - can a variable be used with PHP's object-assignment -> notation?

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsAssignable;
bool IsAssignable::check(mixed $fieldOrVar);
```

## Parameters

`IsAssignable::check()` takes one parameter:

* `mixed $fieldOrVar` - the value to inspect

## Return Value

`IsAssignable::check()` returns a boolean:

* `true` if `$fieldOrVar` can be used with PHP's object-assignment notation
* `false` otherwise

## Throws

`IsAssignable::check()` does not throw any exceptions.

## Works With

`IsAssignable::check()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes