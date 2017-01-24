# get_namespace()

<div class="callout info">
Since v1.4.0
</div>

## Description

`get_namespace()` returns a class or object's namespace.

```php
public static string get_namespace(string|object $item);
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`get_namespace()` returns a string. It contains the namespace that the class or object is defined in.

* if the class or object has a namespace, that namespace is returned
* if the class or object has no namespace, an empty string is returned

## Throws

`get_namespace()` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

## Works With

`get_namespace()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes