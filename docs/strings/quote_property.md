---
currentSection: strings
currentItem: quote_property
pageflow_prev_url: quote_index.html
pageflow_prev_text: quote_index()
pageflow_next_url: vnsprintf.html
pageflow_next_text: vnsprintf()
---

# quote_property()

<div class="callout info" markdown="1">
Since v1.8.0
</div>

## Description

`quote_property()` - surround a string with `{` and `}` if it can't be safely used as a class or object property name in `eval()`

```php
string quote_property(string $item);
```

## Parameters

`quote_property()` takes one parameter:

* `string $item` - the string to add braces to

## Return Value

`quote_property()` returns a string.

* the string will be `{$item}` if braces are required
* the string will be `$item` otherwise

### Example Return Values

Here's a list of examples of accepted input values:

```php
// $obj->exceptionsList
var_dump(quote_property("exceptionsList"));

// outputs:
// string(14) "exceptionsList"
```

```php
// $obj->{0}
var_dump(quote_property(0));

// outputs:
// string(3) "{0}"
```

```php
// $obj->{total-cost}
var_dump(quote_property("total-cost"));

// outputs:
// string(12) "{total-cost}"
```

```php
// $obj->total_cost
var_dump(quote_property("total_cost"));

// outputs:
// string(10) "total_cost"
```

## Throws

`quote_property()` throws an `InvalidArgumentException` if `$item` is not a string or something that can be sensibly cast as a string.

## Works With

`quote_property()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes