---
currentSection: strings
currentItem: quote_index
pageflow_prev_url: index.html
pageflow_prev_text: String Functions
pageflow_next_url: quote_property.html
pageflow_next_text: quote_property()
---

# quote_index()

<div class="callout info" markdown="1">
Since version 1.8.0
</div>

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

## Works With

`quote_index()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
