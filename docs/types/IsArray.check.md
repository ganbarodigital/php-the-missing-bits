# IsArray::check()

{% include ".i/since/1.10.0.twig" %}

## Description

`IsArray::check()` - can a variable be used as a PHP array?

```php
// as static function
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
public static bool IsArray::check(mixed $fieldOrVar);
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

{% include ".i/supports/5.6-7.x.twig" %}
