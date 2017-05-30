# GetArrayTypes::from()

{% include ".i/since/1.3.0.twig" %}

## Description

`GetArrayTypes::from()` returns a list of all strict PHP types for a given PHP array. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes;
public static array GetArrayTypes::from(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetArrayTypes::from()` returns an array.

* If `$item` is not a PHP array, an empty list `[]` is returned
* For arrays, we check to see if the array is a valid PHP `callable`

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
Although PHP arrays and `Traversable` objects are safe to use in a `foreach()` loop, PHP 7.0 type declarations won't let you pass an array into a function or method that expects a `Traversable`.

That's why `GetArrayTypes::from()` does not include `Traversable` in the returned list.
</div>

<div class="callout warning" markdown="1">
You can't pass an `ArrayObject`, `ArrayAccess` or a `Traversable` into any of the `array_XXX()` functions.

That's why `GetArrayTypes::from()` returns an empty list for `ArrayObject`, `ArrayAccess`, and `Traversable`.
</div>

## Examples

Here's a list of examples of accepted input values:

```php
var_dump(GetArrayTypes::from([1,2,3]));

// outputs
//
// array(1) {
//   ["array"]=>
//   string(5) "array"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetArrayTypes::from([GetStrictTypes::class, "from"]));

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
var_dump(GetArrayTypes::from(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(function(){}));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetArrayTypes::from(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from((object)[]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(STDIN));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("true"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("false"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("0.0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("100"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(new Exception(__FILE__)));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from("hello, world!"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(ArrayObject::class));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetArrayTypes::from(Traversable::class));

// outputs
//
// array(0) {
// }
```

## Throws

`GetArrayTypes::from()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
