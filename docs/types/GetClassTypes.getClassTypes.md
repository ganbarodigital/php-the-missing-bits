# GetClassTypes::getClassTypes()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`GetClassTypes::getClassTypes()` returns a list of all strict PHP types for a given class or interface. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;
public array GetClassTypes::getClassTypes(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetClassTypes::getClassTypes()` returns an array.

* If `$item` is not a string or an object, an empty list `[]` is returned
* For strings, if `$item` is not a valid class or interface name, an empty list `[]` is returned
* For classes and objects, we return a list of the class, its parents, and all interfaces it implements (directly or otherwise)
* For interfaces, we return a list of the interface and its parents

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
PHP doesn't support using traits as type-hints or type declarations.

That's why `GetClassTypes::getClassTypes()` does not include any traits in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(function(){}));

// outputs
//
// array(1) {
//   ["Closure"]=>
//   string(7) "Closure"
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(new ArrayObject));

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

$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(new GetStrictTypes));

// outputs
//
// array(1) {
//   ["GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(new Exception(__FILE__)));

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
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(ArrayObject::class));

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
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(Traversable::class));

// outputs
//
// array(1) {
//   ["Traversable"]=>
//   string(11) "Traversable"
// }
```

Here's a list of examples of ingored input values:

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(null));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(true));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(false));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(0.0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(-100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes(STDIN));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("true"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("false"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("0.0"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("0"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("100"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetClassTypes;
var_dump($inspector->getClassTypes("hello, world!"));

// outputs
//
// array(0) {
// }
```

## Throws

`GetClassTypes::getClassTypes()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
