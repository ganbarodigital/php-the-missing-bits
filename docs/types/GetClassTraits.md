---
currentSection: types
currentItem: GetClassTraits
pageflow_prev_url: GetArrayTypes.html
pageflow_prev_text: GetArrayTypes class
pageflow_next_url: GetClassTypes.html
pageflow_next_text: GetClassTypes class
---

# GetClassTraits

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetClassTraits` returns a list of all the traits used by a class or object. The list includes all traits used by parent classes, and by the traits in the list too.

`GetClassTraits` is a deeper-inspecting version of PHP's [`class_uses()`](http://php.net/manual/en/function.class-uses.php).

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTraits;

// call directly
//
// returns an array
var_dump(GetClassTraits::from($data));

// use as an object
//
// returns an array
$inspector = new GetClassTraits;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_class_traits($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetClassTraits` returns an array.

* If `$data` is not a string or an object, an empty list `[]` is returned
* For strings, if `$data` is not a valid class name, an empty list `[]` is returned
* For classes and objects, we return a list of the traits used by the class, its parents, and any traits that any of those classes use

The resulting list is a complete list of the traits used by `$data`.

<div class="callout warning" markdown="1">
PHP doesn't support using traits in interfaces.

That's why `GetClassTraits` always returns an empty list for an interface.
</div>

## Throws

`GetClassTraits` does not throw any exceptions.

## Works With

`GetClassTraits` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
