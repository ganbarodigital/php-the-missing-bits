---
currentSection: types
currentItem: GetDuckTypes
pageflow_prev_url: GetClassTypes.html
pageflow_prev_text: GetClassTypes class
pageflow_next_url: GetNumericType.html
pageflow_next_text: GetNumericType class
---

# GetDuckTypes

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetDuckTypes` returns a list of all possible PHP types for a given variable. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetDuckTypes;

// call directly
//
// returns an array
var_dump(GetDuckTypes::of($data));

// use as an object
//
// returns an array
$inspector = new GetDuckTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_duck_types($data));
```

## Parameters

The input parameters are:

- `$data` - the item to examine

## Return Value

`GetDuckTypes` returns an array. It is a list of the types that `$data` could substitute for.

* For basic scalar types, the list contains the result of PHP's `gettype()`
* For arrays and objects, we check to see if the array is a valid PHP `callable`
* All arrays and instances of `stdClass` are also marked as `Traversable` (they are safe to use in a `foreach` loop)
* For objects, we also include a list of all parent classes
* For objects, we also include a list of all interfaces that the object's class implements
* For objects, we check if it implements '__toString()'
* For strings that are valid class or interface names, we include the class name, a list of all parent classes, and a list of all interfaces that the class implements
* For strings, we check if the string is a valid `double` or `integer`

The resulting list describes how you can safely treat `$data`, as long as you are not calling strictly-typed functions and methods.

Use [`GetStrictTypes`](GetStrictTypes.html) instead if you want a list of types that won't cause an error when used with PHP 7's strict type-hinting support.

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_duck_types(null));

// outputs
//
// array(1) {
//   [0]=>
//   string(4) "NULL"
// }
```

```php
var_dump(get_duck_types([1,2,3]));

// outputs
//
// array(2) {
//   [0]=>
//   string(11) "Traversable"
//   [1]=>
//   string(5) "array"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_duck_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(3) {
//   [0]=>
//   string(8) "callable"
//   [1]=>
//   string(11) "Traversable"
//   [2]=>
//   string(5) "array"
// }
```

```php
var_dump(get_duck_types(function(){}));

// outputs
//
// array(3) {
//   [0]=>
//   string(7) "Closure"
//   [1]=>
//   string(8) "callable"
//   [2]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types(true));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "boolean"
// }
```

```php
var_dump(get_duck_types(false));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "boolean"
// }
```

```php
var_dump(get_duck_types(0.0));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "double"
// }
```

```php
var_dump(get_duck_types(3.1415927));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "double"
// }
```

```php
var_dump(get_duck_types(0));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "integer"
// }
```

```php
var_dump(get_duck_types(100));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "integer"
// }
```

```php
var_dump(get_duck_types(-100));

// outputs
//
// array(1) {
//   [0]=>
//   string(7) "integer"
// }
```

```php
var_dump(get_duck_types(new ArrayObject));

// outputs
//
// array(7) {
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
//   [6]=>
//   string(6) "object"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_duck_types(new GetStrictTypes));

// outputs
//
// array(3) {
//   [0]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
//   [1]=>
//   string(8) "callable"
//   [2]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types((object)[]));

// outputs
//
// array(3) {
//   [0]=>
//   string(8) "stdClass"
//   [1]=>
//   string(11) "Traversable"
//   [2]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types(STDIN));

// outputs
//
// array(1) {
//   [0]=>
//   string(8) "resource"
// }
```

```php
var_dump(get_duck_types("true"));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("false"));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("0.0"));

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
var_dump(get_duck_types("3.1415927"));

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
var_dump(get_duck_types("0"));

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
var_dump(get_duck_types("100"));

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
var_dump(get_duck_types(new Exception(__FILE__)));

// outputs
//
// array(4) {
//   [0]=>
//   string(9) "Exception"
//   [1]=>
//   string(9) "Throwable"
//   [2]=>
//   string(6) "string"
//   [3]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types("hello, world!"));

// outputs
//
// array(1) {
//   [0]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types(ArrayObject::class));

// outputs
//
// array(8) {
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
//   [6]=>
//   string(5) "class"
//   [7]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types(Traversable::class));

// outputs
//
// array(3) {
//   [0]=>
//   string(11) "Traversable"
//   [1]=>
//   string(9) "interface"
//   [2]=>
//   string(6) "string"
// }
```

## Throws

`GetDuckTypes` does not throw any exceptions.

## Constraints

None
