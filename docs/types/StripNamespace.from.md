# StripNamespace::from()

<div class="callout info">
Since v1.4.0
</div>

## Description

`StripNamespace::from()` returns a class or object's class name, minus the namespace.

```php
use GanbaroDigital\MissingBits\TypeInspectors\StripNamespace;
public static string StripNamespace::from(string|object $item);
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`StripNamespace::from()` returns a string. It contains the name of the class or object, without the namespace portion of the name.

## Throws

`StripNamespace::from()` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

## Works With

`StripNamespace::from()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes