---
currentSection: types
currentItem: StripNamespace
pageflow_prev_url: GetStringTypes.html
pageflow_prev_text: GetStringTypes class
---

# StripNamespace

<div class="callout info">
Since v1.4.0
</div>

## Description

`StripNamespace` returns a class or object's class name, minus the namespace.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\StripNamespace;

// call directly
//
// returns a string
var_dump(StripNamespace::from($item));

// use as an object
//
// returns a string
$inspector = new StripNamespace;
var_dump($inspector($item));

// use as a global function
//
// returns a string
var_dump(strip_namespace($item));
```

## Parameters

The input parameters are:

- `$item` - the item to examine. Must an object, or a string containing the name of a valid class, interface or trait.

## Return Value

`StripNamespace` returns a string. It contains the name of the class or object, without the namespace portion of the name.

## Throws

`StripNamespace` throws these exceptions:

* if `$item` is not an object or string, `InvalidArgumentException` is thrown
* if `$item` is a string, but does not contain a defined class, interface or trait, `InvalidArgumentException` is thrown

## Works With

`StripNamespace` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
