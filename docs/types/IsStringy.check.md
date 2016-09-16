# IsStringy

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsStringy::check()` - can we use the variable as a string?

```php
use GanbaroDigital\MissingBits\TypeChecks\IsStringy;
boolean IsStringy::check(mixed $item);
```

## Parameters

`IsStringy::check()` takes one parameter:

* `mixed $item` - the variable to examine

## Return Value

`IsStringy::check()` returns a boolean:

* `true` if PHP will use `$item` as a string
  - strings
  - integers
  - doubles
  - objects with the `__toString()` method
* `false` otherwise
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
