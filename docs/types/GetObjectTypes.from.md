# GetObjectTypes::from()

{% include ".i/since/1.3.0.twig" %}

## Description

`GetObjectTypes::from()` returns a list of all strict PHP types for a given PHP object. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes;
public static array GetObjectTypes::from(object $item);
```

## Parameters

The input parameters are:

- `object $item` - the item to examine

## Return Value

`GetObjectTypes::from()` returns an array.

* If `$item` is not an object, an empty list `[]` is returned
* We return a list of `$item`'s' class, the class's parents, and all interfaces it implements (directly or otherwise)
* We detect if `$item` is invokeable
* We detect if `$item` supports automatic conversion to a string

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
In PHP 7.0, `object` is not valid type declaration. That's why `GetObjectTypes::from()` does not include `object` in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(GetObjectTypes::from(function(){}));

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
var_dump(GetObjectTypes::from(new ArrayObject));

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

var_dump(GetObjectTypes::from(new GetStrictTypes));

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
var_dump(GetObjectTypes::from((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
var_dump(GetObjectTypes::from(new Exception(__FILE__)));

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

Here's a list of examples of ingored input values:

```php
var_dump(GetObjectTypes::from(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetObjectTypes::from([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(STDIN));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("true"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("false"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("0.0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("100"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from("hello, world!"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(ArrayObject::class));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetObjectTypes::from(Traversable::class));

// outputs
//
// array(0) {
// }
```

## Throws

`GetObjectTypes::from()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
