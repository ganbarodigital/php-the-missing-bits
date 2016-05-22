---
currentSection: types
currentItem: GetArrayTypes
pageflow_prev_url: index.html
pageflow_prev_text: Type Functions and Classes
pageflow_next_url: GetClassTypes.html
pageflow_next_text: GetClassTypes class
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

```php
var_dump(get_array_types(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_array_types([1,2,3]));

// outputs
//
// array(1) {
//  [0] =>
//  string(5) "array"
// }
```

```php
var_dump(get_array_types([GetArrayTypes::class, 'from']));

// outputs
//
// array(2) {
//  [0] =>
//  string(8) "callable"
//  [1] =>
//  string(5) "array"
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
var_dump(get_array_types(0));

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
var_dump(get_array_types(new GetDuckTypes));

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
var_dump(get_array_types('100'));

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
