---
currentSection: types
currentItem: GetObjectTypes
pageflow_prev_url: GetDuckTypes.html
pageflow_prev_text: GetDuckTypes class
pageflow_next_url: GetPrintableType.html
pageflow_next_text: GetPrintableType class
---

# GetObjectTypes

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetObjectTypes` returns a list of all strict PHP types for a given PHP object. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes;

// call directly
//
// returns an array
var_dump(GetObjectTypes::from($data));

// use as an object
//
// returns an array
$inspector = new GetObjectTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_object_types($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetObjectTypes` returns an array.

* If `$data` is not an object, an empty list `[]` is returned
* We return a list of the object's class, the class's parents, and all interfaces it implements (directly or otherwise)
* We detect if the object is invokeable
* We detect if the object supports automatic conversion to a string

The resulting list is a complete list of strict types where it is safe to use `$data`.

<div class="callout warning" markdown="1">
In PHP 7.0, `object` is not valid type declaration. That's why `GetObjectTypes` does not include `object` in the returned list.
</div>

### Example Return Values

```php
var_dump(get_object_types(null));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types([1,2,3]));

// outputs
//
// array(0) {
// }
//
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_object_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(function(){}));

// outputs
//
// array(2) {
//   [0]=>
//   string(7) "Closure"
//   [1]=>
//   string(8) "callable"
// }
//
```

```php
var_dump(get_object_types(true));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(false));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(0.0));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(0));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(new ArrayObject));

// outputs
//
// array(6) {
//   [0]=>
//   string(11) "ArrayObject"
//   [1]=>
//   string(17) "IteratorAggregate"
//   [2]=>
//   string(11) "Traversable"
//   [3]=>
//   string(11) "ArrayAccess"
//   [4]=>
//   string(12) "Serializable"
//   [5]=>
//   string(9) "Countable"
// }
//
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_object_types(new GetStrictTypes));

// outputs
//
// array(2) {
//   [0]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
//   [1]=>
//   string(8) "callable"
// }
//
```

```php
var_dump(get_object_types((object)[]));

// outputs
//
// array(1) {
//   [0]=>
//   string(8) "stdClass"
// }
//
```

```php
var_dump(get_object_types("100"));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(ArrayObject::class));

// outputs
//
// array(0) {
// }
//
```

```php
var_dump(get_object_types(Traversable::class));

// outputs
//
// array(0) {
// }
//
```

## Throws

`GetObjectTypes` does not throw any exceptions.

## Works With

`GetObjectTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes