# TraverseObject::using()

{% include ".i/since/1.8.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`TraverseObject::using()` - iterate over an object's public properties

```php
use GanbaroDigital\MissingBits\ListTraversals\TraverseObject;
void TraverseObject::using(object $list, string $listName, callable $callable);
```

## Parameters

`TraverseObject::using()` takes three parameters:

* `object $list` - the list to iterate over
* `string $listName` - what you call `$list` in the calling code
* `callable $callable` - the function to call with each member of `$list`

`$callable` is any PHP `callable`. It should take three parameters:

```php
$callable = function($value, $key, $name) {
    // .. do something here
}
```

* `mixed $value` - a single entry from `$list`
* `mixed $key` - the object attribute of `$value`
* `string $name` - the human-readable name of `$value`, suitable for including in exception messages and logs

For example:

```php
$myList = (object)[
    "harry" => "sally",
    "alice" => "wonderland"
];
$callable = function($value, $key, $name) {
    echo "$name is $value" . PHP_EOL;
}
TraverseArray::using($myList, 'myList', $callable);
```

will output:

    $myList->harry is sally
    $myList->alice is wonderland

## Return Value

`TraverseObject::using()` does not return a value.

## Throws

`TraverseObject::using()` throws an `InvalidArgumentException` if `$list` is not a PHP object.

{% include ".i/supports/5.6-7.x.twig" %}
