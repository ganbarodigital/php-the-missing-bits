# GetClassTraits::getClassTraits()

{% include ".i/since/1.10.0.twig" %}

## Description

`GetClassTraits::getClassTraits()` returns a list of all the traits used by a class or object. The list includes all traits used by parent classes, and by the traits in the list too.

`GetClassTraits::getClassTraits()` is a deeper-inspecting version of PHP's [`class_uses()`](http://php.net/manual/en/function.class-uses.php).

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTraits;
public array GetClassTraits::getClassTraits(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetClassTraits::getClassTraits()` returns an array.

* If `$item` is not a string or an object, an empty list `[]` is returned
* For strings, if `$item` is not a valid class name, an empty list `[]` is returned
* For classes and objects, we return a list of the traits used by the class, its parents, and any traits that any of those classes use

The resulting list is a complete list of the traits used by `$item`.

<div class="callout warning" markdown="1">
PHP doesn't support using traits in interfaces.

That's why `GetClassTraits::getClassTraits()` always returns an empty list for an interface.
</div>

## Throws

`GetClassTraits::getClassTraits()` does not throw any exceptions.

## Works With

`GetClassTraits::getClassTraits()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
