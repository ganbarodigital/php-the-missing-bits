---
currentSection: types
currentItem: GetStringDuckTypes
pageflow_prev_url: GetStrictTypes.html
pageflow_prev_text: GetStrictTypes class
pageflow_next_url: GetStringTypes.html
pageflow_next_text: GetStringTypes class
---

# GetStringDuckTypes

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`GetStringDuckTypes` returns a list of all strict PHP types for a given string. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetStringDuckTypes;

// call directly
//
// returns an array
var_dump(GetStringDuckTypes::from($data));

// use as an object
//
// returns an array
$inspector = new GetStringDuckTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_string_duck_types($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetStringDuckTypes` returns an array.

* If `$data` is an object that implements `::__toString()`, the list `[ 'string' ]` is returned.
* Otherwise, if `$data` is not a string, an empty list `[]` is returned.
* We check `$data` to see if it can be automatically coerced into an `integer` or a `double`. If it can, we return `integer` or `double`, and we also return `numeric`.
* We check `$data` to see if it contains a class name or an interface name. If it does, we return the full class hierarchy, plus also `class` or `interface` as appropriate.

The resulting list is a complete list of string-related duck types for `$data`.

<div class="callout warning" markdown="1">
PHP does not automatically convert `'true'` or `'false'` into booleans.

That's why `GetStringDuckTypes` doesn't add `'boolean'` to the list of returned types if a string contains the text of a boolean value.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_string_duck_types("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_duck_types("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_duck_types("0.0"));

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
var_dump(get_string_duck_types("3.1415927"));

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
var_dump(get_string_duck_types("0"));

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
var_dump(get_string_duck_types("100"));

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
var_dump(get_string_duck_types(new Exception(__FILE__)));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_duck_types("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_duck_types(ArrayObject::class));

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
var_dump(get_string_duck_types(Traversable::class));

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
var_dump(get_string_duck_types(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_string_duck_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(function(){}));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_string_duck_types(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types((object)[]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_duck_types(STDIN));

// outputs
//
// array(0) {
// }
```

## Throws

`GetStringDuckTypes` does not throw any exceptions.

## Works With

`GetStringDuckTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
