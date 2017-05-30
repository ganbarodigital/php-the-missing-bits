# GetClassTypes::from()

{% include ".i/since/1.3.0.twig" %}

## Description

`GetClassTypes::from()` returns a list of all strict PHP types for a given class or interface. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;
public static array GetClassTypes::from(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetClassTypes::from()` returns an array.

* If `$item` is not a string or an object, an empty list `[]` is returned
* For strings, if `$item` is not a valid class or interface name, an empty list `[]` is returned
* For classes and objects, we return a list of the class, its parents, and all interfaces it implements (directly or otherwise)
* For interfaces, we return a list of the interface and its parents

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
PHP doesn't support using traits as type-hints or type declarations.

That's why `GetClassTypes::from()` does not include any traits in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(GetClassTypes::from(function(){}));

// outputs
//
// array(1) {
//   ["Closure"]=>
//   string(7) "Closure"
// }
```

```php
var_dump(GetClassTypes::from(new ArrayObject));

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
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetClassTypes::from(new GetStrictTypes));

// outputs
//
// array(1) {
//   ["GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
// }
```

```php
var_dump(GetClassTypes::from((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
var_dump(GetClassTypes::from(new Exception(__FILE__)));

// outputs
//
// array(2) {
//   ["Exception"]=>
//   string(9) "Exception"
//   ["Throwable"]=>
//   string(9) "Throwable"
// }
```

```php
var_dump(GetClassTypes::from(ArrayObject::class));

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
var_dump(GetClassTypes::from(Traversable::class));

// outputs
//
// array(1) {
//   ["Traversable"]=>
//   string(11) "Traversable"
// }
```

Here's a list of examples of ingored input values:

```php
var_dump(GetClassTypes::from(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetClassTypes::from([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from(STDIN));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("true"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("false"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("0.0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("100"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetClassTypes::from("hello, world!"));

// outputs
//
// array(0) {
// }
```

## Throws

`GetClassTypes::from()` does not throw any exceptions.

## Works With

`GetClassTypes::from()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
