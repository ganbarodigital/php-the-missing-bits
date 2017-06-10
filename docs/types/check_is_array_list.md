# check_is_array_list()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`check_is_array_list()` - does a list contain only values we can use with `array_XXX()` functions?

```php
check_is_array_list(mixed $list) : bool
```

`check_is_array_list()` is a convenience wrapper around [`IsArray::checkList()`](IsArray.checkList.html).

## Parameters

`check_is_array_list()` takes one parameter:

* `$list` (mixed) - the list to check

## Return Values

`check_is_array_list()` returns a boolean:

* `TRUE` if `$list`:
  - is a list of some kind (see [`IsList::check()`](../types/IsList.check.html)), and
  - every entry in `$list` can be safely passed into PHP's `array_XXX()` functions
* `FALSE` otherwise

## Examples

{% include ".i/examples/check_is_array_list/Example-1--Check-For-List-Of-Arrays.twig" %}
{% include ".i/examples/check_is_array_list/Example-2--Check-For-Non-Arrays-In-List.twig" %}
{% include ".i/examples/check_is_array_list/Example-3--Catch-Non-Lists.twig" %}

{% include ".i/contracts/check_is_array_list.twig" %}
{% include ".i/supports/5.6-7.x.twig" %}