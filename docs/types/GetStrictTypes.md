---
currentSection: types
currentItem: GetStrictTypes
pageflow_prev_url: GetPrintableType.html
pageflow_prev_text: GetPrintableType class
pageflow_next_url: GetStringTypes.html
pageflow_next_text: GetStringTypes class
---

# GetStrictTypes

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetStrictTypes` returns a list of all strict PHP types for a given value or variable. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

// call directly
//
// returns an array
var_dump(GetStrictTypes::from($data));

// use as an object
//
// returns an array
$inspector = new GetStrictTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_strict_types($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetStrictTypes` returns an array. It contains a list of all valid PHP types for `$data`.

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_strict_types(null));

// outputs
//
// array(1) {
//   [0]=>
//   string(4) "NULL"
// }
```

```php
var_dump(get_strict_types([1,2,3]));

// outputs
//
// array(1) {
//   [0]=>
//   string(5) "array"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_strict_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(2) {
//   [0]=>
//   string(8) "callable"
//   [1]=>
//   string(5) "array"
// }
```

```php
var_dump(get_strict_types(function(){}));

// outputs
//
// array(2) {
//   [0]=>
//   string(7) "Closure"
//   [1]=>
//   string(8) "callable"
// }
```

```php
var_dump(get_strict_types(true));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "boolean"
// }
```

```php
var_dump(get_strict_types(false));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "boolean"
// }
```

```php
var_dump(get_strict_types(0.0));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "double"
// }
```

```php
var_dump(get_strict_types(3.1415927));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "double"
// }
```

```php
var_dump(get_strict_types(0));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "integer"
// }
```

```php
var_dump(get_strict_types(100));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "integer"
// }
```

```php
var_dump(get_strict_types(-100));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "integer"
// }
```

```php
var_dump(get_strict_types(new ArrayObject));

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
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_strict_types(new GetStrictTypes));

// outputs
//
// array(2) {
//   [0]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
//   [1]=>
//   string(8) "callable"
// }
```

```php
var_dump(get_strict_types((object)[]));

// outputs
//
// array(1) {
//   [0]=>
//   string(8) "stdClass"
// }
```

```php
var_dump(get_strict_types(STDIN));

// outputs
//
// array(1) {
//   [0]=>
//   string(8) "resource"
// }
```

```php
var_dump(get_strict_types("true"));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types("false"));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types("0.0"));

// outputs
//
// array(2) {
//   [0]=>
//   string(6) "double"
//   [1]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types("3.1415927"));

// outputs
//
// array(2) {
//   [0]=>
//   string(6) "double"
//   [1]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types("0"));

// outputs
//
// array(2) {
//   [0]=>
//   string(7) "integer"
//   [1]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types("100"));

// outputs
//
// array(2) {
//   [0]=>
//   string(7) "integer"
//   [1]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types(new Exception(__FILE__)));

// outputs
//
// array(3) {
//   [0]=>
//   string(9) "Exception"
//   [1]=>
//   string(9) "Throwable"
//   [2]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types("hello, world!"));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types(ArrayObject::class));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_strict_types(Traversable::class));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

## Throws

`GetStrictTypes` does not throw any exceptions.

## Works With

`GetStrictTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
