---
currentSection: types
currentItem: GetClassTypes
pageflow_prev_url: GetArrayTypes.html
pageflow_prev_text: GetArrayTypes class
pageflow_next_url: GetDuckTypes.html
pageflow_next_text: GetDuckTypes class
---

# GetClassTypes

<div class="callout warning">
Not yet in a tagged release
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

* If `$data` is not a string, an empty list `[]` is returned
* If `$data` is not a valid class or interface name, an empty list `[]` is returned
* For classes, we return a list of the class, its parents, and all interfaces it implements (directly or otherwise)
* For interfaces, we return a list of the interface and its parents

The resulting list is a complete list of strict types where it is safe to use `$data`.

<div class="callout warning" markdown="1">
PHP doesn't support using traits as type-hints or type declarations.

That's why `GetClassTypes` does not include any traits in the returned list.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_class_types(ArrayObject::class));

// outputs
//
// array(6) {
//   [0]=>
//   string(11) "ArrayObject"
//   [1]=>
//   string(17) "IteratorAggregate"
//   [2]=>
//   string(11) "Traversable"
//   [3]=>
//   string(11) "ArrayAccess"
//   [4]=>
//   string(12) "Serializable"
//   [5]=>
//   string(9) "Countable"
// }
```

```php
var_dump(get_class_types(Traversable::class));

// outputs
//
// array(1) {
//   [0]=>
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
var_dump(get_class_types(function(){}));

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
var_dump(get_class_types(0));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types(new ArrayObject));

// outputs
//
// array(0) {
// }
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_class_types(new GetStrictTypes));

// outputs
//
// array(0) {
// }
```

```php
var_dump(get_class_types((object)[]));

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
