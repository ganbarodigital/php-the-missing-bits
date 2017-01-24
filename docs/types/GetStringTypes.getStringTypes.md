# GetStringTypes::getStringTypes()

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetStringTypes::getStringTypes()` returns a list of all strict PHP types for a given string. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes;
public array GetStringTypes::getStringTypes(mixed $item);
```

## Parameters

`GetStringTypes::getStringTypes()` takes one parameter:

- `mixed $item` - the item to examine

## Return Value

`GetStringTypes::getStringTypes()` returns an array of strings.

* If `$item` is an object that implements `::__toString()`, the list `[ 'string' ]` is returned.
* Otherwise, if `$item` is not a string, an empty list `[]` is returned
* We check `item` to see if it can be automatically coerced into an `integer` or a `double`

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
PHP does not automatically convert `'true'` or `'false'` into booleans.

That's why `GetStringTypes::getStringTypes()` doesn't add `'boolean'` to the list of returned types if a string contains the text of a boolean value.
</div>

<div class="callout warning" markdown="1">
Use [`GetClassTypes`](GetClassTypes.html) if want to get list of a class's parent classes and interfaces.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("0.0"));

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
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("3.1415927"));

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
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("0"));

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
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("100"));

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
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(new Exception(__FILE__)));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(ArrayObject::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(Traversable::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

Here's a list of examples of ingored input values:

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(null));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(function(){}));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(true));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(false));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(0.0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(-100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes((object)[]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetStringTypes;
var_dump($inspector->getStringTypes(STDIN));

// outputs
//
// array(0) {
// }
```

## Throws

`GetStringTypes::getStringTypes()` does not throw any exceptions.

## Works With

`GetStringTypes::getStringTypes()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
