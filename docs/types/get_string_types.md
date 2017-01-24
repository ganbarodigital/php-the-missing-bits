# get_string_types()

<div class="callout info">
Since v1.3.0
</div>

## Description

`get_string_types()` returns a list of all strict PHP types for a given string. The list is ordered with the most specific match first.

```php
public array get_string_types(mixed $item);
```

## Parameters

`get_string_types()` takes one parameter:

- `mixed $item` - the item to examine

## Return Value

`get_string_types()` returns an array of strings.

* If `$item` is an object that implements `::__toString()`, the list `[ 'string' ]` is returned.
* Otherwise, if `$item` is not a string, an empty list `[]` is returned
* We check `item` to see if it can be automatically coerced into an `integer` or a `double`

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
PHP does not automatically convert `'true'` or `'false'` into booleans.

That's why `get_string_types()` doesn't add `'boolean'` to the list of returned types if a string contains the text of a boolean value.
</div>

<div class="callout warning" markdown="1">
Use [`get_class_types()`](get_class_types.html) if want to get list of a class's parent classes and interfaces.
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

`get_string_types()` does not throw any exceptions.

## Works With

`get_string_types()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
