# GetStrictTypes::getStrictTypes()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`GetStrictTypes::getStrictTypes()` returns a list of all strict PHP types for a given value or variable. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;
public array GetStrictTypes::getStrictTypes($item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetStrictTypes::getStrictTypes()` returns an array. It contains a list of all valid PHP types for `$item`.

### Example Return Values

Here's a list of examples of accepted input values:

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(null));

// outputs
//
// array(1) {
//   ["NULL"]=>
//   string(4) "NULL"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes([1,2,3]));

// outputs
//
// array(1) {
//   ["array"]=>
//   string(5) "array"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes([GetStrictTypes::class, "from"]));

// outputs
//
// array(2) {
//   ["callable"]=>
//   string(8) "callable"
//   ["array"]=>
//   string(5) "array"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(function(){}));

// outputs
//
// array(2) {
//   ["Closure"]=>
//   string(7) "Closure"
//   ["callable"]=>
//   string(8) "callable"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(true));

// outputs
//
// array(1) {
//   ["boolean"]=>
//   string(7) "boolean"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(false));

// outputs
//
// array(1) {
//   ["boolean"]=>
//   string(7) "boolean"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(0.0));

// outputs
//
// array(1) {
//   ["double"]=>
//   string(6) "double"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(3.1415927));

// outputs
//
// array(1) {
//   ["double"]=>
//   string(6) "double"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(0));

// outputs
//
// array(1) {
//   ["integer"]=>
//   string(7) "integer"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(100));

// outputs
//
// array(1) {
//   ["integer"]=>
//   string(7) "integer"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(-100));

// outputs
//
// array(1) {
//   ["integer"]=>
//   string(7) "integer"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(new ArrayObject));

// outputs
//
// array(6) {
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
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(new GetStrictTypes));

// outputs
//
// array(2) {
//   ["GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
//   ["callable"]=>
//   string(8) "callable"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(STDIN));

// outputs
//
// array(1) {
//   ["resource"]=>
//   string(8) "resource"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("0.0"));

// outputs
//
// array(2) {
//   ["double"]=>
//   string(6) "double"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("3.1415927"));

// outputs
//
// array(2) {
//   ["double"]=>
//   string(6) "double"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("0"));

// outputs
//
// array(2) {
//   ["integer"]=>
//   string(7) "integer"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("100"));

// outputs
//
// array(2) {
//   ["integer"]=>
//   string(7) "integer"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(new Exception(__FILE__)));

// outputs
//
// array(3) {
//   ["Exception"]=>
//   string(9) "Exception"
//   ["Throwable"]=>
//   string(9) "Throwable"
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(ArrayObject::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStrictTypes;
var_dump($inspector->getStrictTypes(Traversable::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

## Throws

`GetStrictTypes::getStrictTypes()` does not throw any exceptions.

## Works With

`GetStrictTypes::getStrictTypes()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
