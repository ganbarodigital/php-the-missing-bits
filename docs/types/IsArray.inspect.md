# IsArray::inspect()

{% include ".i/since/1.10.0.twig" %}

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

{% include ".i/supports/5.6-7.x.twig" %}
