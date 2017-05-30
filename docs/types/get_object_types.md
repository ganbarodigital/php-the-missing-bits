# get_object_types()

{% include ".i/since/1.3.0.twig" %}

## Description

`get_object_types()` returns a list of all strict PHP types for a given PHP object. The list is ordered with the most specific match first.

```php
public static array get_object_types(object $item);
```

## Parameters

The input parameters are:

- `object $item` - the item to examine

## Return Value

`get_object_types()` returns an array.

* If `$item` is not an object, an empty list `[]` is returned
* We return a list of `$item`'s' class, the class's parents, and all interfaces it implements (directly or otherwise)
* We detect if `$item` is invokeable
* We detect if `$item` supports automatic conversion to a string

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
In PHP 7.0, `object` is not valid type declaration. That's why `get_object_types()` does not include `object` in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_object_types(function(){}));

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
var_dump(get_object_types(new ArrayObject));

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

var_dump(get_object_types(new GetStrictTypes));

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
var_dump(get_object_types((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
var_dump(get_object_types(new Exception(__FILE__)));

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
var_dump(get_object_types(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_object_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(STDIN));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("true"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("false"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("0.0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("100"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types("hello, world!"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(ArrayObject::class));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_object_types(Traversable::class));

// outputs
//
// array(0) {
// }
```

## Throws

`get_object_types()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
