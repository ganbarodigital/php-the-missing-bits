# strip_namespace()

<div class="callout info">
Since v1.4.0
</div>

## Description

`strip_namespace()` returns a class or object's class name, minus the namespace.

```php
public string strip_namespace(string|object $item);
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`strip_namespace()` returns a string. It contains the name of the class or object, without the namespace portion of the name.

## Throws

`strip_namespace()` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

## Works With

`strip_namespace()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
