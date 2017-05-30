# get_duck_types()

{% include ".i/since/1.3.0.twig" %}

## Description

`get_duck_types()` returns a list of all possible PHP types for a given variable. The list is ordered with the most specific match first.

```php
public array get_duck_types(mixed $item);
```

## Parameters

The input parameters are:

- `$item` - the item to examine

## Return Value

`get_duck_types()` returns an array. It is a list of the types that `$item` could substitute for.

* For basic scalar types, the list contains the result of PHP's `gettype()`
* For arrays and objects, we check to see if the array is a valid PHP `callable`
* All arrays and instances of `stdClass` are also marked as `Traversable` (they are safe to use in a `foreach` loop)
* For objects, we also include a list of all parent classes
* For objects, we also include a list of all interfaces that the object's class implements
* For objects, we check if it implements '__toString()'
* For strings that are valid class or interface names, we include the class name, a list of all parent classes, and a list of all interfaces that the class implements
* For strings, we check if the string is a valid `double` or `integer`

The resulting list describes how you can safely treat `$item`, as long as you are not calling strictly-typed functions and methods.

Use [`get_strict_types()`](get_strict_types.html) instead if you want a list of types that won't cause an error when used with PHP 7's strict type-hinting support.

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_duck_types(null));

// outputs
//
// array(1) {
//   ["NULL"]=>
//   string(4) "NULL"
// }
```

```php
var_dump(get_duck_types([1,2,3]));

// outputs
//
// array(2) {
//   ["Traversable"]=>
//   string(11) "Traversable"
//   ["array"]=>
//   string(5) "array"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_duck_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(3) {
//   ["callable"]=>
//   string(8) "callable"
//   ["Traversable"]=>
//   string(11) "Traversable"
//   ["array"]=>
//   string(5) "array"
// }
```

```php
var_dump(get_duck_types(function(){}));

// outputs
//
// array(3) {
//   ["Closure"]=>
//   string(7) "Closure"
//   ["callable"]=>
//   string(8) "callable"
//   ["object"]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types(true));

// outputs
//
// array(1) {
//   ["boolean"]=>
//   string(7) "boolean"
// }
```

```php
var_dump(get_duck_types(false));

// outputs
//
// array(1) {
//   ["boolean"]=>
//   string(7) "boolean"
// }
```

```php
var_dump(get_duck_types(0.0));

// outputs
//
// array(2) {
//   ["double"]=>
//   string(6) "double"
//   ["numeric"]=>
//   string(7) "numeric"
// }
```

```php
var_dump(get_duck_types(3.1415927));

// outputs
//
// array(2) {
//   ["double"]=>
//   string(6) "double"
//   ["numeric"]=>
//   string(7) "numeric"
// }
```

```php
var_dump(get_duck_types(0));

// outputs
//
// array(2) {
//   ["integer"]=>
//   string(7) "integer"
//   ["numeric"]=>
//   string(7) "numeric"
// }
```

```php
var_dump(get_duck_types(100));

// outputs
//
// array(2) {
//   ["integer"]=>
//   string(7) "integer"
//   ["numeric"]=>
//   string(7) "numeric"
// }
```

```php
var_dump(get_duck_types(-100));

// outputs
//
// array(2) {
//   ["integer"]=>
//   string(7) "integer"
//   ["numeric"]=>
//   string(7) "numeric"
// }
```

```php
var_dump(get_duck_types(new ArrayObject));

// outputs
//
// array(7) {
//   ["ArrayObject"]=>
//   string(11) "ArrayObject"
//   ["IteratorAggregate"]=>
//   string(17) "IteratorAggregate"
//   ["Traversable"]=>
//   string(11) "Traversable"
//   ["ArrayAccess"]=>
//   string(11) "ArrayAccess"
//   ["Serializable"]=>
//   string(12) "Serializable"
//   ["Countable"]=>
//   string(9) "Countable"
//   ["object"]=>
//   string(6) "object"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_duck_types(new GetStrictTypes));

// outputs
//
// array(3) {
//   ["GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
//   ["object"]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types((object)[]));

// outputs
//
// array(3) {
//   ["stdClass"]=>
//   string(8) "stdClass"
//   ["Traversable"]=>
//   string(11) "Traversable"
//   ["object"]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types(STDIN));

// outputs
//
// array(1) {
//   ["resource"]=>
//   string(8) "resource"
// }
```

```php
var_dump(get_duck_types("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("0.0"));

// outputs
//
// array(3) {
//   ["double"]=>
//   string(6) "double"
//   ["numeric"]=>
//   string(7) "numeric"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("3.1415927"));

// outputs
//
// array(3) {
//   ["double"]=>
//   string(6) "double"
//   ["numeric"]=>
//   string(7) "numeric"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("0"));

// outputs
//
// array(3) {
//   ["integer"]=>
//   string(7) "integer"
//   ["numeric"]=>
//   string(7) "numeric"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types("100"));

// outputs
//
// array(3) {
//   ["integer"]=>
//   string(7) "integer"
//   ["numeric"]=>
//   string(7) "numeric"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types(new Exception(__FILE__)));

// outputs
//
// array(4) {
//   ["Exception"]=>
//   string(9) "Exception"
//   ["Throwable"]=>
//   string(9) "Throwable"
//   ["string"]=>
//   string(6) "string"
//   ["object"]=>
//   string(6) "object"
// }
```

```php
var_dump(get_duck_types("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types(ArrayObject::class));

// outputs
//
// array(8) {
//   ["ArrayObject"]=>
//   string(11) "ArrayObject"
//   ["IteratorAggregate"]=>
//   string(17) "IteratorAggregate"
//   ["Traversable"]=>
//   string(11) "Traversable"
//   ["ArrayAccess"]=>
//   string(11) "ArrayAccess"
//   ["Serializable"]=>
//   string(12) "Serializable"
//   ["Countable"]=>
//   string(9) "Countable"
//   ["class"]=>
//   string(5) "class"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_duck_types(Traversable::class));

// outputs
//
// array(3) {
//   ["Traversable"]=>
//   string(11) "Traversable"
//   ["interface"]=>
//   string(9) "interface"
//   ["string"]=>
//   string(6) "string"
// }
```

## Throws

`get_duck_types()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}

## Changelog

### v1.5.1

- Now returns the `numeric` duck type for `double` and `integer` PHP types.

### v1.5.0

- Now returns the `numeric` duck type for strings that can be doubles or integers.
