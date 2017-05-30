# IsAssignable::check()

{% include ".i/since/1.10.0.twig" %}

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

{% include ".i/supports/5.6-7.x.twig" %}
