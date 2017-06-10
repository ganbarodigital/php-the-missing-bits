# get_numeric_type()

{% include ".i/since/1.3.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`get_numeric_type()` returns `integer` or `double` if the input variable is a numeric type, or can be automatically coerced into a numeric type by PHP.

```php
public string|null get_numeric_type(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`get_numeric_type()` returns a string on success, or `NULL` otherwise.

* If `$item` is not numeric, `NULL` is returned.
* If `$item` is already an `integer` or a `double`, we return `integer` or `double` accordingly.
* if `$item` is a string, we convert it to a number, and return `integer` or `double` accordingly.

<div class="callout warning" markdown="1">
`get_numeric_type()` relies on PHP's `is_numeric()`. `is_numeric()` behaves differently in PHP 5.x and PHP 7.0.
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

`get_numeric_type()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
