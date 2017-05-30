# GetNumericType::from()

{% include ".i/since/1.3.0.twig" %}

## Description

`GetNumericType::from()` returns `integer` or `double` if the input variable is a numeric type, or can be automatically coerced into a numeric type by PHP.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;
public static string|null GetNumericType::from(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetNumericType::from()` returns a string on success, or `NULL` otherwise.

* If `$item` is not numeric, `NULL` is returned.
* If `$item` is already an `integer` or a `double`, we return `integer` or `double` accordingly.
* if `$item` is a string, we convert it to a number, and return `integer` or `double` accordingly.

<div class="callout warning" markdown="1">
`GetNumericType::from()` relies on PHP's `is_numeric()`. `is_numeric()` behaves differently in PHP 5.x and PHP 7.0.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(GetNumericType::from(0.0));

// outputs
//
// string(6) "double"
```

```php
var_dump(GetNumericType::from(0));

// outputs
//
// string(7) "integer"
```

```php
var_dump(GetNumericType::from("0.0"));

// outputs
//
// string(6) "double"
```

```php
var_dump(GetNumericType::from("3.1415927"));

// outputs
//
// string(6) "double"
```

```php
var_dump(GetNumericType::from("0"));

// outputs
//
// string(7) "integer"
```

```php
var_dump(GetNumericType::from("100"));

// outputs
//
// string(7) "integer"
```

Here's a list of examples of ingored input values:

```php
var_dump(GetNumericType::from(null));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from([1,2,3]));

// outputs
//
// NULL
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetNumericType::from([GetStrictTypes::class, "from"]));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(function(){}));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(true));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(false));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(new ArrayObject));

// outputs
//
// NULL
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

var_dump(GetNumericType::from(new GetStrictTypes));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from((object)[]));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(STDIN));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from("true"));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from("false"));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from("hello, world!"));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(ArrayObject::class));

// outputs
//
// NULL
```

```php
var_dump(GetNumericType::from(Traversable::class));

// outputs
//
// NULL
```

## Throws

`GetNumericType::from()` does not throw any exceptions.

## Works With

`GetNumericType::from()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
