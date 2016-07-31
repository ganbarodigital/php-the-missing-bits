---
currentSection: types
currentItem: GetStringTypes
pageflow_prev_url: GetStringDuckTypes.html
pageflow_prev_text: GetStringDuckTypes class
pageflow_next_url: IsList.html
pageflow_next_text: IsList class
---

# GetStringTypes

<div class="callout info">
Since v1.3.0
</div>

## Description

`GetStringTypes` returns a list of all strict PHP types for a given string. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes;

// call directly
//
// returns an array
var_dump(GetStringTypes::from($data));

// use as an object
//
// returns an array
$inspector = new GetStringTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_string_types($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetStringTypes` returns an array.

* If `$data` is an object that implements `::__toString()`, the list `[ 'string' ]` is returned.
* Otherwise, if `$data` is not a string, an empty list `[]` is returned
* We check `$data` to see if it can be automatically coerced into an `integer` or a `double`

The resulting list is a complete list of strict types where it is safe to use `$data`.

<div class="callout warning" markdown="1">
PHP does not automatically convert `'true'` or `'false'` into booleans.

That's why `GetStringTypes` doesn't add `'boolean'` to the list of returned types if a string contains the text of a boolean value.
</div>

<div class="callout warning" markdown="1">
Use [`GetClassTypes`](GetClassTypes.html) if want to get list of a class's parent classes and interfaces.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_string_types("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_types("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_types("0.0"));

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
var_dump(get_string_types("3.1415927"));

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
var_dump(get_string_types("0"));

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
var_dump(get_string_types("100"));

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
var_dump(get_string_types(new Exception(__FILE__)));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_types("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_types(ArrayObject::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(get_string_types(Traversable::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

Here's a list of examples of ingored input values:

```php
var_dump(get_string_types(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_string_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(function(){}));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_string_types(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types((object)[]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_string_types(STDIN));

// outputs
//
// array(0) {
// }
```

## Throws

`GetStringTypes` does not throw any exceptions.

## Works With

`GetStringTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
