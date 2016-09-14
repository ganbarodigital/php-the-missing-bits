---
currentSection: classes-objects
currentItem: property-helpers
pageflow_prev_url: FilterProperties.from.html
pageflow_prev_text: FilterProperties::from()
---

# HasFilteredProperties::check()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`HasFilteredProperties::check()` - does a class or object have properties that pass the filter?

```php
bool HasFilteredProperties::check(ReferenceClass $target, int $propTypes, callable $resultFilter);
```

## Parameters

`HasFilteredProperties::check()` takes three parameters:

* `$refObj` ([ReflectionClass](http://www.php.net/ReflectionClass)) - the class or object to examine
* `$propTypes` (int) - scope filter (uses the [ReflectionProperty](http://www.php.net/ReflectionProperty) constants)
* `$resultFilter` (callable) - function to filter the properties and decide the final result (see below)

### The Result Filter

The `$resultFilter` parameter is a callable. It must have this function signature:

```php
boolean function(ReflectionProperty $refProp);
```

where:

* `$refProp` ([ReflectionProperty](http://www.php.net/ReflectionProperty)) is a property discovered by `FilterProperties::from()`

`HasFilteredProperties::check()` will call `$resultFilter()` with each discovered property. If your `$resultFilter` callable returns `true`, `HasFilteredProperties::check()` will stop discovering properties and return `true` to the caller.

For example:

```php
// in this example, $target is the object that we want to filter
$resultFilter = function(ReflectionProperty $refProp) use($target) {
    // only store object properties
    if (!$refProp->isStatic()) {
        return false;
    }

    return true;
};
```

## Return Value

`HasFilteredProperties::check()` returns a boolean:

* `true` if a property passes the `$resultFilter`,
* `false` otherwise.

## Throws

`HasFilteredProperties::check()` does not throw any exceptions.
