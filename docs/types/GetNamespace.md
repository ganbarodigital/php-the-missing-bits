---
currentSection: types
currentItem: GetNamespace
pageflow_prev_url: GetDuckTypes.html
pageflow_prev_text: GetDuckTypes class
pageflow_next_url: GetNumericType.html
pageflow_next_text: GetNumericType class
---

# GetNamespace

<div class="callout info">
Since v1.4.0
</div>

## Description

`GetNamespace` returns a class or object's namespace.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;

// call directly
//
// returns a string
var_dump(GetNamespace::from($item));

// use as an object
//
// returns a string
$inspector = new GetNamespace;
var_dump($inspector($item));

// use as a global function
//
// returns a string
var_dump(get_namespace($item));
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`GetNamespace` returns a string. It contains the namespace that the class or object is defined in.

* if the class or object has a namespace, that namespace is returned
* if the class or object has no namespace, an empty string is returned

## Throws

`GetNamespace` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

## Works With

`GetNamespace` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
