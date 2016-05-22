---
currentSection: types
currentItem: GetArrayTypes
pageflow_prev_url: index.html
pageflow_prev_text: Type Functions and Classes
pageflow_next_url: GetClassTraits.html
pageflow_next_text: GetClassTraits class
---

# GetArrayTypes

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetArrayTypes` returns a list of all strict PHP types for a given PHP array. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes;

// call directly
//
// returns an array
var_dump(GetArrayTypes::from($data));

// use as an object
//
// returns an array
$inspector = new GetArrayTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_array_types($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetArrayTypes` returns an array.

* If `$data` is not a PHP array, an empty list `[]` is returned
* For arrays, we check to see if the array is a valid PHP `callable`

The resulting list is a complete list of strict types where it is safe to use `$data`.

<div class="callout warning" markdown="1">
Although PHP arrays and `Traversable` objects are safe to use in a `foreach` loop, PHP 7.0 type declarations won't let you pass an array into a function or method that expects a `Traversable`.

That's why `GetArrayTypes` does not include `Traversable` in the returned list.
</div>

<div class="callout warning" markdown="1">
You can't pass an `ArrayObject`, `ArrayAccess` or a `Traversable` into any of the `array_XXX()` functions.

That's why `GetArrayTypes` returns an empty list for `ArrayObject`, `ArrayAccess`, and `Traversable`.
</div>

### Example Return Values

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

## Works With

`GetArrayTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
