---
currentSection: types
currentItem: GetNumericType
pageflow_prev_url: GetNamespace.html
pageflow_prev_text: GetNamespace class
pageflow_next_url: GetObjectTypes.html
pageflow_next_text: GetObjectTypes class
---

# GetNumericType

<div class="callout info">
Since v1.3.0
</div>

## Description

`GetNumericType` returns `integer` or `double` if the input variable is a numeric type, or can be automatically coerced into a numeric type by PHP.

```php
// how to import
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;

// call directly
//
// returns an array
var_dump(GetNumericType::from($data));

// use as an object
//
// returns an array
$inspector = new GetNumericType;
var_dump($inspector($data));

// use as a global function
//
// returns an array
var_dump(get_numeric_type($data));
```

## Parameters

The input parameters are:

- `mixed $data` - the item to examine

## Return Value

`GetNumericType` returns a string on success, or `NULL` otherwise.

* If `$data` is not numeric, `NULL` is returned.
* If `$data` is already an `integer` or a `double`, we return `integer` or `double` accordingly.
* if `$data` is a string, we convert it to a number, and return `integer` or `double` accordingly.

<div class="callout warning" markdown="1">
`GetNumericType` relies on PHP's `is_numeric()`. `is_numeric()` behaves differently in PHP 5.x and PHP 7.0.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(get_numeric_type(0.0));

// outputs
//
// string(6) "double"
```

```php
var_dump(get_numeric_type(0));

// outputs
//
// string(7) "integer"
```

```php
var_dump(get_numeric_type("0.0"));

// outputs
//
// string(6) "double"
```

```php
var_dump(get_numeric_type("3.1415927"));

// outputs
//
// string(6) "double"
```

```php
var_dump(get_numeric_type("0"));

// outputs
//
// string(7) "integer"
```

```php
var_dump(get_numeric_type("100"));

// outputs
//
// string(7) "integer"
```

Here's a list of examples of ingored input values:

```php
var_dump(get_numeric_type(null));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type([1,2,3]));

// outputs
//
// NULL
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_numeric_type([GetStrictTypes::class, "from"]));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(function(){}));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(true));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(false));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(new ArrayObject));

// outputs
//
// NULL
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(get_numeric_type(new GetStrictTypes));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type((object)[]));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(STDIN));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type("true"));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type("false"));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type("hello, world!"));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(ArrayObject::class));

// outputs
//
// NULL
```

```php
var_dump(get_numeric_type(Traversable::class));

// outputs
//
// NULL
```

## Throws

`GetNumericType` does not throw any exceptions.

## Works With

`GetNumericType` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
