# GetStrictTypes::from()

{% include ".i/since/1.3.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetStrictTypes::from()` returns a list of all strict PHP types for a given value or variable. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;
public static array GetStrictTypes::from($item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetStrictTypes::from()` returns an array. It contains a list of all valid PHP types for `$item`.

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(GetStrictTypes::from(null));

// outputs
//
// array(1) {
//   ["NULL"]=>
//   string(4) "NULL"
// }
```

```php
var_dump(GetStrictTypes::from([1,2,3]));

// outputs
//
// array(1) {
//   ["array"]=>
//   string(5) "array"
// }
```

```php
var_dump(GetStrictTypes::from([GetStrictTypes::class, "from"]));

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
var_dump(GetStrictTypes::from(function(){}));

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
var_dump(GetStrictTypes::from(true));

// outputs
//
// array(1) {
//   ["boolean"]=>
//   string(7) "boolean"
// }
```

```php
var_dump(GetStrictTypes::from(false));

// outputs
//
// array(1) {
//   ["boolean"]=>
//   string(7) "boolean"
// }
```

```php
var_dump(GetStrictTypes::from(0.0));

// outputs
//
// array(1) {
//   ["double"]=>
//   string(6) "double"
// }
```

```php
var_dump(GetStrictTypes::from(3.1415927));

// outputs
//
// array(1) {
//   ["double"]=>
//   string(6) "double"
// }
```

```php
var_dump(GetStrictTypes::from(0));

// outputs
//
// array(1) {
//   ["integer"]=>
//   string(7) "integer"
// }
```

```php
var_dump(GetStrictTypes::from(100));

// outputs
//
// array(1) {
//   ["integer"]=>
//   string(7) "integer"
// }
```

```php
var_dump(GetStrictTypes::from(-100));

// outputs
//
// array(1) {
//   ["integer"]=>
//   string(7) "integer"
// }
```

```php
var_dump(GetStrictTypes::from(new ArrayObject));

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
var_dump(GetStrictTypes::from(new GetStrictTypes));

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
var_dump(GetStrictTypes::from((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
var_dump(GetStrictTypes::from(STDIN));

// outputs
//
// array(1) {
//   ["resource"]=>
//   string(8) "resource"
// }
```

```php
var_dump(GetStrictTypes::from("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStrictTypes::from("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStrictTypes::from("0.0"));

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
var_dump(GetStrictTypes::from("3.1415927"));

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
var_dump(GetStrictTypes::from("0"));

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
var_dump(GetStrictTypes::from("100"));

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
var_dump(GetStrictTypes::from(new Exception(__FILE__)));

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
var_dump(GetStrictTypes::from("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStrictTypes::from(ArrayObject::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStrictTypes::from(Traversable::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

## Throws

`GetStrictTypes::from()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
