# get_printable_type()

<div class="callout info" markdown="1">
Since version 1.1.0
</div>

## Description

`get_printable_type()` returns the PHP type of the data that you pass to it.

It is designed for use in error logging and exception messages. It is a replacement for PHP's built-in `gettype()` function.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;
public string get_printable_type(mixed $item, int $flags = GetPrintableType::FLAGS_DEFAULT);
```

## Parameters

`get_printable_type()` takes the following parameters:

* `$item` - the PHP variable to examine
* `$flags` - bit-mask of options to add extra information to the return value

The following flags are supported:

Flag | Behaviour
-----|--------
`GetPrintableType::FLAG_NONE` | no extra information required (default behaviour)
`GetPrintableType::FLAG_CLASSNAME` | add the `class` or `interface` name if `$item` is a PHP object
`GetPrintableType::FLAG_CALLABLE_DETAILS` | add the `class` (if present) and function or method name of the callable
`GetPrintableType::FLAG_SCALAR_VALUE` | adds the value of `$item` if `$item` is a boolean, double, integer or string

If `$flags` is not provided, it defaults to `GetPrintableType::FLAG_DEFAULTS`. This contains the following flag(s):

* `GetPrintableType::FLAG_CLASSNAME`
* `GetPrintableType::FLAG_CALLABLE_DETAILS`
* `GetPrintableType::FLAG_SCALAR_VALUE`

## Return Value

`get_printable_type()` returns a `string`, which contains the PHP type of `$item`:

No Flags | If Flag | Then
---------|---------|------
`NULL` | n/a | n/a
`array` | n/a | n/a
`boolean` | `GetPrintableType::FLAG_SCALAR_VALUE` | `boolean<true>` or `boolean<false>`
`callable` | `GetPrintableType::FLAG_CALLABLE_DETAILS` | `callable<function>` or `callable<classname::method>`
`double` | `GetPrintableType::FLAG_SCALAR_VALUE` | `double<value>`
`integer` | `GetPrintableType::FLAG_SCALAR_VALUE` | `integer<value>`
`object` | `GetPrintableType::FLAG_CLASSNAME` | `object<classname>`
`resource` | n/a | n/a
`string` | `GetPrintableType::FLAG_SCALAR_VALUE` | `string<value>`

<div class="callout info" markdown="1">
#### Callables over Arrays and Strings

If you pass in an array that is also a valid `callable`, `get_printable_type()` will return `callable`.

The same goes for strings. If you pass in a string that is also a valid `callable`, `get_printable_type()` will return `callable`.
</div>

<div class="callout info" markdown="1">
#### Callables over Closure

PHP turns anonymous functions into objects of type `Closure`. `get_printable_type()` will return `callable` instead of `object<Closure>`.
</div>

<div class="callout warning" markdown="1">
#### PHP 7.0, gettype() and Strict Types

`get_printable_type()` is built on top of PHP's built-in `gettype()` function.

PHP 7.0 introduced strict type checking for functions. Unfortunately, `gettype()` in PHP 7.0 doesn't return these new strict types. (We assume this is to preserve backwards-compatibility).

At some point in the future, we'll introduce our own `get_strict_type()` function, and add a `GetPrintableType::FLAG_STRICT_TYPES` to make use of it.
</div>

## Throws

`get_printable_type()` does not throw any exceptions.

## Notes

None at this time.

## Changelog

### v1.6.1

* Improved robustness of `$flags`

  If `$flags` isn't an integer, we now use the default flags. Same goes if `$flags` is an integer, but contains a value that's outside the range of valid bitmask flags.
