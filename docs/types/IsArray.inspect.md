# IsArray::inspect()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`IsArray::inspect()` - can a variable be used as a PHP array?

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
public bool IsArray::inspect(mixed $fieldOrVar);
```

## Parameters

`IsArray::inspect()` takes one parameter:

* `mixed $fieldOrVar` - the value to inspect

## Return Value

`IsArray::inspect()` returns a boolean:

* `true` if `$fieldOrVar` can be used as a PHP array
* `false` otherwise

## Throws

`IsArray::inspect()` does not throw any exceptions.

## Works With

`IsArray::inspect()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes