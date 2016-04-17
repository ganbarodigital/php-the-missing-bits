---
currentSection: types
currentItem: GetPrintableType
pageflow_prev_url: index.html
pageflow_prev_text: Type Functions and Classes
---

# GetPrintableType

<div class="callout warning" markdown="1">
Not yet in a tagged release.
</div>

## Description

`GetPrintableType` returns the PHP type of the data that you pass to it.

It is designed for use in error logging and exception messages. It is a replacement for PHP's built-in `gettype()` function.

```php
// how to import
use GanbaroDigital\ExceptionHelpers\V1\Types\Inspectors\GetPrintableType;

// call directly
//
// returns a string
echo GetPrintableType::of($data);

// use as an object
//
// returns a string
$inspector = new GetPrintableType;
echo $inspector($data);

// use as a global function
echo get_printable_type($data);
```

## Parameters

The input parameters are:

* `$data` - the PHP variable to examine
* `$flags` - bit-mask of options to add extra information to the return value

The following flags are supported:

Flag | Behaviour
-----|--------
`GetPrintableType::FLAG_NONE` | no extra information required (default behaviour)
`GetPrintableType::FLAG_CLASSNAME` | add the `class` or `interface` name if `$data` is a PHP object
`GetPrintableType::FLAG_CALLABLE_DETAILS` | add the `class` (if present) and function or method name of the callable

If `$flags` is not provided, it defaults to `GetPrintableType::FLAG_DEFAULTS`.

## Return Value

`GetPrintableType` returns a `string`, which contains the PHP type of `$data`:

* `NULL`
* `array`
* `boolean`
* `callable`
* `double`
* `integer`
* `object`
* `resource`
* `string`

<div class="callout info" markdown="1">
#### Callables over Arrays

If you pass in an array that is also a valid `callable`, `GetPrintableType` will return `callable`.

</div>
<div class="callout info" markdown="1">
#### Callables over Closure

PHP turns anonymous functions into objects of type `Closure`. `GetPrintableType` will return `callable` instead of `object<Closure>`.
</div>

## Throws

`GetPrintableType` does not throw any exceptions.

## Constraints

None.
