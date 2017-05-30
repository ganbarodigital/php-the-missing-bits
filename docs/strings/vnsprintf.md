# vnsprintf()

{% include ".i/since/1.0.0.twig" %}

## Description

`vnsprintf()` - PHP's `vsprintf()` with added support for _named arguments_.

```php
string vnsprintf(string $format, array $args);
```

## Parameters

`vnsprintf()` takes two parameters:

* `$format` (string) - a [sprintf()-compatible](http://php.net/manual/en/function.sprintf.php) format string, which may also contained _named parameters_
* `$args` (array) - a list of data values for `sprintf()` to use when `$format` is expanded

PHP's built-in `sprintf()` already supports _positional parameters_:

```php
echo vsprintf("The %1\$s sat on the %2\$s", ['cat', 'mat']) . PHP_EOL;
// output: The cat sat on the mat
```

`vnsprintf()` adds support for using _named parameters_ too:

```php
$args = [
    'animal' => 'cat',
    'place' => 'mat'
];
echo vnsprintf("The %animal\$s sat on the %place\$s", $args) . PHP_EOL;
// output: The cat sat on the mat
```

## Return Values

`vnsprintf()` returns a string: the result of expanding `$format` using the data in `$args`.

## Throws

`vnsprintf()` throws the following exception(s):

* `InvalidArgumentException` - if you use a _named parameter_ that can't be found in `$args`

## Constraints

Internally, `vnsprintf()` converts `$format` into a `sprintf()`-compatible format string. As a result, `$format` must be one of the following:

* 100%-compatible with `sprintf()`, or
* use only _named parameters_, or
* use a mix of _named parameters_ and _positional parameters_

You __cannot__ do the following:

* use a mix of _named parameters_ and normal (non-position) parameters in `$format`
* use a mix of _positional parameters_ and normal (non-positional) parameters in `$format`

If you do so, you'll get an error message from PHP.
