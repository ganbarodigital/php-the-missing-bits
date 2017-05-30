# GetStringDuckTypes::getStringDuckTypes()

{% include ".i/since/1.10.0.twig" %}

## Description

`GetStringDuckTypes::getStringDuckTypes()` returns a list of all possible PHP types for a given string. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStringDuckTypes;
public array GetStringDuckTypes::getStringDuckTypes(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetStringDuckTypes::getStringDuckTypes()` returns an array.

* If `$item` is an object that implements `::__toString()`, the list `[ 'string' ]` is returned.
* Otherwise, if `$item` is not a string, an empty list `[]` is returned.
* We check `$item` to see if it can be automatically coerced into an `integer` or a `double`. If it can, we return `integer` or `double`, and we also return `numeric`.
* We check `$item` to see if it contains a class name or an interface name. If it does, we return the full class hierarchy, plus also `class` or `interface` as appropriate.

The resulting list is a complete list of string-related duck types for `$item`.

<div class="callout warning" markdown="1">
PHP does not automatically convert `'true'` or `'false'` into booleans.

That's why `GetStringDuckTypes::getStringDuckTypes` doesn't add `'boolean'` to the list of returned types if a string contains the text of a boolean value.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("0.0"));

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
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("3.1415927"));

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
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("0"));

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
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("100"));

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
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(new Exception(__FILE__)));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(ArrayObject::class));

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
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(Traversable::class));

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

Here's a list of examples of ingored input values:

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(null));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(function(){}));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(true));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(false));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(0.0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(-100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes((object)[]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringDuckTypes;
var_dump($inspector->getStringDuckTypes(STDIN));

// outputs
//
// array(0) {
// }
```

## Throws

`GetStringDuckTypes::getStringDuckTypes()` does not throw any exceptions.

## Works With

`GetStringDuckTypes::getStringDuckTypes()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
