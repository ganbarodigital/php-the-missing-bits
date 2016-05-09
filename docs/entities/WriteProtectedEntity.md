---
currentSection: entities
currentItem: WriteProtectableEntity
pageflow_prev_url: WriteProtectableEntity.html
pageflow_prev_text: WriteProtectableEntity interface
pageflow_next_url: WriteProtectTab.html
pageflow_next_text: WriteProtectTab trait
---

# WriteProtectedEntity

<div class="callout info">
Since v1.2.0
</div>

## Description

`WriteProtectedEntity` is an interface. It is implemented by all objects that:

1. are read-only after construction, and
1. support being made read-write again

## Public Interface

`WriteProtectedEntity` has the following public interface:

```php
// `WriteProtectedEntity` lives in this namespace
namespace GanbaroDigital\MissingBits\Entities;

// our base classes and interfaces
use GanbaroDigital\MissingBits\Entities\WriteProtectableEntity;

interface WriteProtectedEntity extends WriteProtectableEntity
{
    /**
     * can we edit this entity?
     *
     * @return boolean
     *         FALSE if we can edit this entity
     *         TRUE otherwise
     *
     * @inheritedFrom WriteProtectableEntity
     */
    public function isReadOnly();

    /**
     * can we edit this entity?
     *
     * @return boolean
     *         TRUE if we can edit this entity
     *         FALSE otherwise
     *
     * @inheritedFrom WriteProtectableEntity
     */
    public function isReadWrite();

    /**
     * disable editing this entity
     *
     * @return void
     *
     * @inheritedFrom WriteProtectableEntity
     */
    public function setReadOnly();

    /**
     * enable editing this entity
     *
     * @return void
     *
     * @inheritedFrom WriteProtectableEntity
     */
    public function setReadWrite();
}
```

## How To Use

### Implementing This Interface

In your object's constructor, always call `$this->setReadOnly()` before your constructor completes:

```php
use GanbaroDigital\MissingBits\Entities\ReadOnlyException;
use GanbaroDigital\MissingBits\Entities\WriteProtectedEntity;

class MyEntity extends WriteProtectedEntity
{
    public function __construct($name)
    {
        // remember the name
        $this->name = $name;

        // all done
        $this->setReadOnly();
    }
}
```

In your object's `setXXX()` methods, always check `$this->isReadOnly()` before changing data. If `$this->isReadOnly()` returns `true`, throw a `ReadOnlyException`:

```php
use GanbaroDigital\MissingBits\Entities\ReadOnlyException;
use GanbaroDigital\MissingBits\Entities\WriteProtectedEntity;

class MyEntity extends WriteProtectedEntity
{
    public function setName($name)
    {
        // are we write-protected atm?
        if ($this->isReadOnly()) {
            throw new ReadOnlyException("cannot edit MyEntity");
        }

        // if we get here, we can change the name
        $this->name = $name;
    }
}
```

## Notes

None at this time.

## See Also

* [`ReadOnlyException`](ReadOnlyException.html) - exception thrown when attempting to edit a read-only entity
* [`WriteProtectableEntity`](WriteProtectedEntity.html) - interface implemented by entities that support switching into read-only mode
* [`WriteProtectTab`](WriteProtectTab.html) - simple implementation of the `WriteProtectableEntity` interface, as a trait
