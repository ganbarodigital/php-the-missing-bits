# get_array_types()

{% include ".i/since/1.3.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`get_array_types()` returns a list of all strict PHP types for a given PHP array. The list is ordered with the most specific match first.

```php
public array get_array_types(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`get_array_types()` returns an array.

* If `$item` is not a PHP array, an empty list `[]` is returned
* For arrays, we check to see if the array is a valid PHP `callable`

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
Although PHP arrays and `Traversable` objects are safe to use in a `foreach()` loop, PHP 7.0 type declarations won't let you pass an array into a function or method that expects a `Traversable`.

That's why `get_array_types()` does not include `Traversable` in the returned list.
</div>

<div class="callout warning" markdown="1">
You can't pass an `ArrayObject`, `ArrayAccess` or a `Traversable` into any of the `array_XXX()` functions.

That's why `get_array_types()` returns an empty list for `ArrayObject`, `ArrayAccess`, and `Traversable`.
</div>

## Examples

Here's a list of examples of accepted input values:

```php
var_dump(get_array_types([1,2,3]));

// outputs
//
// array(1) {
//   ["array"]=>
//   string(5) "array"
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_array_types([GetStrictTypes::class, "from"]));

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
var_dump(get_array_types(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(function(){}));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_array_types(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types((object)[]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(STDIN));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("true"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("false"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("0.0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("100"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(new Exception(__FILE__)));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types("hello, world!"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(ArrayObject::class));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types(Traversable::class));

// outputs
//
// array(0) {
// }
```

## Throws

`GetArrayTypes` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
