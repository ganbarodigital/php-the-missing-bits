# GetObjectTypes::getObjectTypes()

{% include ".i/since/1.10.0.twig" %}

## Description

`GetObjectTypes::getObjectTypes()` returns a list of all strict PHP types for a given PHP object. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes;
public array GetObjectTypes::getObjectTypes(object $item);
```

## Parameters

The input parameters are:

- `object $item` - the item to examine

## Return Value

`GetObjectTypes::getObjectTypes()` returns an array.

* If `$item` is not an object, an empty list `[]` is returned
* We return a list of `$item`'s' class, the class's parents, and all interfaces it implements (directly or otherwise)
* We detect if `$item` is invokeable
* We detect if `$item` supports automatic conversion to a string

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
In PHP 7.0, `object` is not valid type declaration. That's why `GetObjectTypes::getObjectTypes()` does not include `object` in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(function(){}));

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
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(new ArrayObject));

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

$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(new GetStrictTypes));

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
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(new Exception(__FILE__)));

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
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(null));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(true));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(false));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(0.0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(-100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(STDIN));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("true"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("false"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("0.0"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("0"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("100"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes("hello, world!"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(ArrayObject::class));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetObjectTypes;
var_dump($inspector->getObjectTypes(Traversable::class));

// outputs
//
// array(0) {
// }
```

## Throws

`GetObjectTypes::getObjectTypes()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
