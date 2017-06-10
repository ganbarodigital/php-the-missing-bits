# check_is_array()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`check_is_array()` - can we use a value with PHP's `array_XXX()` functions?

```php
check_is_array(mixed $fieldOrVar) : bool
```

## Parameters

`check_is_array` takes one parameter:

* `$fieldOrVar` (mixed) - the value to examine

## Return Values

`check_is_array()` returns a boolean:

* `TRUE` if `$fieldOrVar` can be used with PHP's `array_XXX()` functions
* `FALSE` otherwise

## Examples

{% include ".i/examples/check_is_array/Example-1--Check-If-Array.twig" %}
{% include ".i/examples/check_is_array/Example-2--Check-If-Not-Array.twig" %}

{% include ".i/contracts/check_is_array.twig" %}
{% include ".i/supports/5.6-7.x.twig" %}