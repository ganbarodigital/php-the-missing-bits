---
currentSection: entities
currentItem: WriteProtectableEntity
pageflow_prev_url: ReadOnlyException.html
pageflow_prev_text: ReadOnlyException class
pageflow_next_url: WriteProtectedEntity.html
pageflow_next_text: WriteProtectedEntity interface
---

# WriteProtectableEntity

<div class="callout info">
Since v1.2.0
</div>

## Description

`WriteProtectableEntity` is an interface. It is implemented by all objects that support being switched into a read-only mode.

## Public Interface

`WriteProtectableEntity` has the following public interface:

```php
// `WriteProtectableEntity` lives in this namespace
namespace GanbaroDigital\MissingBits\Entities;

interface WriteProtectableEntity
{
    /**
     * can we edit this entity?
     *
     * @return boolean
     *         FALSE if we can edit this entity
     *         TRUE otherwise
     */
    public function isReadOnly();

    /**
     * can we edit this entity?
     *
     * @return boolean
     *         TRUE if we can edit this entity
     *         FALSE otherwise
     */
    public function isReadWrite();

    /**
     * disable editing this entity
     *
     * @return void
     */
    public function setReadOnly();

    /**
     * enable editing this entity
     *
     * @return void
     */
    public function setReadWrite();
}
```

## How To Use

### Implementing This Interface

In your object's `setXXX()` methods, always check `$this->isReadOnly()` before changing data. If `$this->isReadOnly()` returns `true`, throw a `ReadOnlyException`:

```php
use GanbaroDigital\MissingBits\Entities\ReadOnlyException;
use GanbaroDigital\MissingBits\Entities\WriteProtectableEntity;

class MyEntity extends WriteProtectableEntity
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
* [`WriteProtectedEntity`](WriteProtectedEntity.html) - interface implemented by entities that are read-only after construction
* [`WriteProtectTab`](WriteProtectTab.html) - simple implementation of the `WriteProtectableEntity` interface, as a trait
