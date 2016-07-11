---
currentSection: strings
currentItem: addbraces
pageflow_prev_url: index.html
pageflow_prev_text: String Functions
pageflow_next_url: vnsprintf.html
pageflow_next_text: vnsprintf()
---

# addbraces()

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`addbraces()` - surround a string with `{` and `}` if it can't be safely used as a class or object property name in `eval()`

```php
string addbraces(string $item);
```

## Parameters

`addbraces()` takes one parameter:

* `string $item` - the string to add braces too

## Return Value

`addbraces()` returns a string.

* the string will be `{$item}` if braces are required
* the string will be `$item` otherwise

### Example Return Values

Here's a list of examples of accepted input values:

```php
// $obj->exceptionsList
var_dump(addbraces("exceptionsList"));

// outputs:
// string(14) "exceptionsList"
```

```php
// $obj->{0}
var_dump(addbraces(0));

// outputs:
// string(3) "{0}"
```

```php
// $obj->{total-cost}
var_dump(addbraces("total-cost"));

// outputs:
// string(12) "{total-cost}"
```

```php
// $obj->total_cost
var_dump(addbraces("total_cost"));

// outputs:
// string(10) "total_cost"
```

## Throws

`addbraces()` throws an `InvalidArgumentException` if `$item` is not a string or something that can be sensibly cast as a string.

## Works With

`addbraces()` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
