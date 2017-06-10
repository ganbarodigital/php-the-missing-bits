# quote_index()

{% include ".i/since/1.8.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`quote_index()` - surround an array index with `'` and `'`

```php
mixed quote_index(mixed $key);
```

## Discussion

Use `quote_index()` to build up error messages about array indexes:

```php
foreach ($list as $key => $value) {
    if (!$value) {
        throw new InvalidArgumentException(
            '$list[' . quote_index($key) . '] is invalid'
        );
    }
}
```

`quote_index()` will correctly quote array keys that are strings, and leave numeric array keys unquoted.

## Parameters

`quote_index()` takes one parameter:

* `mixed $key` - the array key to add quotes to

## Return Value

`quote_index()` returns a mixture of data types

* the return value will be `'$key'` if `$key` is a string

If you call `quote_index()` with anything that isn't a string, `$key` is returned unchanged.

### Example Return Values

Here's a list of examples of accepted input values:

```php
var_dump(quote_index("exceptionsList"));

// outputs:
// string(16) "'exceptionsList'"
```

```php
var_dump(quote_index(0));

// outputs:
// int(0)
```

## Throws

`quote_index()` does not throw any exceptions.

{% include ".i/supports/5.6-7.x.twig" %}
