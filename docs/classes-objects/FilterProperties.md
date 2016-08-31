---
currentSection: classes-objects
currentItem: FilterProperties
pageflow_prev_url: has_object_properties.html
pageflow_prev_text: has_object_properties()
---

# FilterProperties

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`FilterProperties::from()` - get the properties from a class or object

```php
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterProperties;

array FilterProperties::from(ReflectionClass $refObj, int $propTypes, callable $resultFilter);
```

## Parameters

`FilterProperties::from()` takes three parameters:

* `$refObj` ([ReflectionClass](http://www.php.net/ReflectionClass)) - the class or object to examine
* `$propTypes` (int) - scope filter (uses the [ReflectionProperty](http://www.php.net/ReflectionProperty) constants)
* `$resultFilter` (callable) - function to filter the properties and build the final result (see below)

### The Result Filter

The `$resultFilter` parameter is a callable. It must have this function signature:

```php
boolean function(ReflectionProperty $refProp, array &$finalResult);
```

where:

* `$refProp` ([ReflectionProperty](http://www.php.net/ReflectionProperty)) is a property discovered by `FilterProperties::from()`
* `$finalResult` (array reference) contains all of the properties to be returned when `FilterProperties::from()` has completed

`FilterProperties::from()` will call `$resultFilter()` with each discovered property. Your `$resultFilter` callable is responsible for storing the property in `$finalResult`.

<div class="callout danger">
Only properties stored in `$finalResult` will be returned by `FilterProperties::from()`!
</div>

For example:

```php
// in this example, $target is the object that we want to filter
$resultFilter = function(ReflectionProperty $refProp, &$finalResult) use($target) {
    // only store object properties
    if ($refProp->isStatic()) {
        return;
    }

    // store the property to be returned to the caller
    $knownProperties[$refProp->getName()] = $refProp->getValue($target);
};
```

## Return Values

`FilterProperties::from()` returns an array of name / value pairs. The exact contents of this return value is decided by your `$resultFilter` callable.

## Throws

`FilterProperties::from()` does not throw any exceptions.

## Notes

None at this time.
