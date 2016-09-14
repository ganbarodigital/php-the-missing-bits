---
currentSection: entities
currentItem: defining-entities
pageflow_prev_url: defining-entities.html
pageflow_prev_text: Defining Entities
pageflow_next_url: WriteProtectableEntity.class.html
pageflow_next_text: WriteProtectableEntity interface
---

# ReadOnlyException

<div class="callout info">
Since v1.2.0
</div>

## Description

`ReadOnlyException` is an exception. It is thrown whenever you attempt to edit an entity that is currently set to read-only.

## Public Interface

`ReadOnlyException` has the following public interface:

```php
// ReadOnlyException lives in this namespace
namespace GanbaroDigital\MissingBits\Entities;

// our base classes and interfaces
use LogicException;

class ReadOnlyException extends LogicException
{

}
```

## Class Contract

Here is the contract for this class:

    GanbaroDigital\MissingBits\Entities\ReadOnlyException
     [x] Can instantiate
     [x] Is logic exception

Class contracts are built from this class's unit tests.

<div class="callout success">
Future releases of this class will not break this contract.
</div>

<div class="callout info" markdown="1">
Future releases of this class may add to this contract. New additions may include:

* clarifying existing behaviour (e.g. stricter contract around input or return types)
* add new behaviours (e.g. extra class methods)
</div>

<div class="callout warning" markdown="1">
When you use this class, you can only rely on the behaviours documented by this contract.

If you:

* find other ways to use this class,
* or depend on behaviours that are not covered by a unit test,
* or depend on undocumented internal states of this class,

... your code may not work in the future.
</div>

## Notes

None at this time.

## See Also

* [`LogicException`](http://php.net/manual/en/class.logicexception.php) - SPL class included in PHP
