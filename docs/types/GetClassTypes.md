---
currentSection: types
currentItem: GetClassTypes
pageflow_prev_url: GetClassTraits.html
pageflow_prev_text: GetClassTraits class
pageflow_next_url: GetDuckTypes.html
pageflow_next_text: GetDuckTypes class
---

# GetClassTypes

<div class="callout info">
Since v1.3.0
</div>

## Description

`GetClassTypes` returns a list of all strict PHP types for a given class or interface. The list is ordered with the most specific match first.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;

// call directly
//
// returns an array
var_dump(GetClassTypes::from($data));

// use as an object
//
// returns an array
$inspector = new GetClassTypes;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_class_types($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetClassTypes` returns an array.

* If `$data` is not a string or an object, an empty list `[]` is returned
* For strings, if `$data` is not a valid class or interface name, an empty list `[]` is returned
* For classes and objects, we return a list of the class, its parents, and all interfaces it implements (directly or otherwise)
* For interfaces, we return a list of the interface and its parents

The resulting list is a complete list of strict types where it is safe to use `$data`.

<div class="callout warning" markdown="1">
PHP doesn't support using traits as type-hints or type declarations.

That's why `GetClassTypes` does not include any traits in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_class_types(function(){}));

// outputs
//
// array(1) {
//   ["Closure"]=>
//   string(7) "Closure"
// }
```

```php
var_dump(get_class_types(new ArrayObject));

// outputs
//
// array(6) {
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
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_class_types(new GetStrictTypes));

// outputs
//
// array(1) {
//   ["GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"]=>
//   string(56) "GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes"
// }
```

```php
var_dump(get_class_types((object)[]));

// outputs
//
// array(1) {
//   ["stdClass"]=>
//   string(8) "stdClass"
// }
```

```php
var_dump(get_class_types(new Exception(__FILE__)));

// outputs
//
// array(2) {
//   ["Exception"]=>
//   string(9) "Exception"
//   ["Throwable"]=>
//   string(9) "Throwable"
// }
```

```php
var_dump(get_class_types(ArrayObject::class));

// outputs
//
// array(6) {
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
// }
```

```php
var_dump(get_class_types(Traversable::class));

// outputs
//
// array(1) {
//   ["Traversable"]=>
//   string(11) "Traversable"
// }
```

Here's a list of examples of ingored input values:

```php
var_dump(get_class_types(null));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types([1,2,3]));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_class_types([GetStrictTypes::class, "from"]));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(true));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(false));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(0.0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(3.1415927));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(-100));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(STDIN));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("true"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("false"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("0.0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("3.1415927"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("0"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("100"));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types("hello, world!"));

// outputs
//
// array(0) {
// }
```

## Throws

`GetClassTypes` does not throw any exceptions.

## Works With

`GetClassTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
