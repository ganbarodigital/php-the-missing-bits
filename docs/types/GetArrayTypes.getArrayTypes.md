# GetArrayTypes::getArrayTypes()

{% include ".i/since/1.10.0.twig" %}

## Description

`GetArrayTypes::getArrayTypes()` returns a list of all strict PHP types for a given PHP array. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes;
public array GetArrayTypes::getArrayTypes(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetArrayTypes::getArrayTypes()` returns an array.

* If `$item` is not a PHP array, an empty list `[]` is returned
* For arrays, we check to see if the array is a valid PHP `callable`

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
Although PHP arrays and `Traversable` objects are safe to use in a `foreach()` loop, PHP 7.0 type declarations won't let you pass an array into a function or method that expects a `Traversable`.

That's why `GetArrayTypes::getArrayTypes()` does not include `Traversable` in the returned list.
</div>

<div class="callout warning" markdown="1">
You can't pass an `ArrayObject`, `ArrayAccess` or a `Traversable` into any of the `array_XXX()` functions.

That's why `GetArrayTypes::getArrayTypes()` returns an empty list for `ArrayObject`, `ArrayAccess`, and `Traversable`.
</div>

## Examples

Here's a list of examples of accepted input values:

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes([1,2,3]));

// outputs
//
// array(1) {
//   ["array"]=>
//   string(5) "array"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes([GetStrictTypes::class, "from"]));

// outputs
//
// array(2) {
//   ["callable"]=>
//   string(8) "callable"
//   ["array"]=>
//   string(5) "array"
// }
```

Here's a list of examples of ingored input values:

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(null));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(function(){}));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(true));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(false));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(0.0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(0));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(-100));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes((object)[]));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(STDIN));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("true"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("false"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("0.0"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("0"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("100"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(new Exception(__FILE__)));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes("hello, world!"));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(ArrayObject::class));

// outputs
//
// array(0) {
// }
```

```php
$inspector = new GetArrayTypes;
var_dump($inspector->getArrayTypes(Traversable::class));

// outputs
//
// array(0) {
// }
```

## Throws

`GetArrayTypes::getArrayTypes()` does not throw any exceptions.

## Works With

`GetArrayTypes::getArrayTypes()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
