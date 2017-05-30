# GetNumericType::getNumericType()

{% include ".i/since/1.10.0.twig" %}

## Description

`GetNumericType::getNumericType()` returns `integer` or `double` if the input variable is a numeric type, or can be automatically coerced into a numeric type by PHP.

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;
public string|null GetNumericType::getNumericType(mixed $item);
```

## Parameters

The input parameters are:

- `mixed $item` - the item to examine

## Return Value

`GetNumericType::getNumericType()` returns a string on success, or `NULL` otherwise.

* If `$item` is not numeric, `NULL` is returned.
* If `$item` is already an `integer` or a `double`, we return `integer` or `double` accordingly.
* if `$item` is a string, we convert it to a number, and return `integer` or `double` accordingly.

<div class="callout warning" markdown="1">
`GetNumericType::getNumericType()` relies on PHP's `is_numeric()`. `is_numeric()` behaves differently in PHP 5.x and PHP 7.0.
</div>

### Example Return Values

Here's a list of examples of accepted input values:

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(0.0));

// outputs
//
// string(6) "double"
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(0));

// outputs
//
// string(7) "integer"
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("0.0"));

// outputs
//
// string(6) "double"
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("3.1415927"));

// outputs
//
// string(6) "double"
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("0"));

// outputs
//
// string(7) "integer"
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("100"));

// outputs
//
// string(7) "integer"
```

Here's a list of examples of ingored input values:

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(null));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType([1,2,3]));

// outputs
//
// NULL
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetNumericType;
var_dump($inspector->getNumericType([GetStrictTypes::class, "from"]));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(function(){}));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(true));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(false));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(new ArrayObject));

// outputs
//
// NULL
```

```php
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;

$inspector = new GetNumericType;
var_dump($inspector->getNumericType(new GetStrictTypes));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType((object)[]));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(STDIN));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("true"));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("false"));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType("hello, world!"));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(ArrayObject::class));

// outputs
//
// NULL
```

```php
$inspector = new GetNumericType;
var_dump($inspector->getNumericType(Traversable::class));

// outputs
//
// NULL
```

## Throws

`GetNumericType::getNumericType()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
