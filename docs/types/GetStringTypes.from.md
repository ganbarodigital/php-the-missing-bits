# GetStringTypes::from()

<div class="callout info">
Since v1.3.0
</div>

## Description

`GetStringTypes::from()` returns a list of all strict PHP types for a given string. The list is ordered with the most specific match first.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes;
public static array GetStringTypes::from(mixed $item);
```

## Parameters

`GetStringTypes::from()` takes one parameter:

- `mixed $item` - the item to examine

## Return Value

`GetStringTypes::from()` returns an array of strings.

* If `$item` is an object that implements `::__toString()`, the list `[ 'string' ]` is returned.
* Otherwise, if `$item` is not a string, an empty list `[]` is returned
* We check `item` to see if it can be automatically coerced into an `integer` or a `double`

The resulting list is a complete list of strict types where it is safe to use `$item`.

<div class="callout warning" markdown="1">
PHP does not automatically convert `'true'` or `'false'` into booleans.

That's why `GetStringTypes::from()` doesn't add `'boolean'` to the list of returned types if a string contains the text of a boolean value.
</div>

<div class="callout warning" markdown="1">
Use [`GetClassTypes`](GetClassTypes.html) if want to get list of a class's parent classes and interfaces.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(GetStringTypes::from("true"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStringTypes::from("false"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStringTypes::from("0.0"));

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
var_dump(GetStringTypes::from("3.1415927"));

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
var_dump(GetStringTypes::from("0"));

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
var_dump(GetStringTypes::from("100"));

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
var_dump(GetStringTypes::from(new Exception(__FILE__)));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStringTypes::from("hello, world!"));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStringTypes::from(ArrayObject::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

```php
var_dump(GetStringTypes::from(Traversable::class));

// outputs
//
// array(1) {
//   ["string"]=>
//   string(6) "string"
// }
```

Here's a list of examples of ingored input values:

```php
var_dump(GetStringTypes::from(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetStringTypes::from([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(function(){}));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetStringTypes::from(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from((object)[]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(GetStringTypes::from(STDIN));

// outputs
//
// array(0) {
// }
```

## Throws

`GetStringTypes::from()` does not throw any exceptions.

## Works With

`GetStringTypes::from()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
