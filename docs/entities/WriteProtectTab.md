---
currentSection: entities
currentItem: WriteProtectableEntity
pageflow_prev_url: WriteProtectedEntity.html
pageflow_prev_text: WriteProtectedEntity interface
---

# WriteProtectTab

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`WriteProtectTab` is a trait. It provides a simple implementation of the [`WriteProtectableEntity`](WriteProtectableEntity.html) interface. It can also be used for objects that implement the [`WriteProtectedEntity`](WriteProtectedEntity.html) interface.

<div class="callout info">
The name comes from tape cassettes. The write-protect tab is a little bit of plastic that you could snap off to prevent recording over the cassette's contents. If you did want to record onto the tape again, you'd put a small piece of tape over the hole where the write-protect tab used to be.
</div>

## Public Interface

`WriteProtectTab` has the following public interface:

```php
// `WriteProtectTab` lives in this namespace
namespace GanbaroDigital\MissingBits\Entities;

// our base classes and interfaces
use GanbaroDigital\MissingBits\Entities\WriteProtectableEntity;

// our return types and exceptions
use GanbaroDigital\MissingBits\Entities\ReadOnlyException;

trait WriteProtectTab
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

    /**
     * throw an exception if the object is not in read-write mode
     *
     * @return void
     * @throws ReadOnlyException
     */
    protected function requireReadWrite();
}
```

## How To Use

### Adding This Trait To Your Class

Traits are not allowed to declare that they implement an interface. Your class needs to say that it implements either `WriteProtectableEntity` or `WriteProtectedEntity`:

```php
use GanbaroDigital\MissingBits\Entities\WriteProtectedEntity;
use GanbaroDigital\MissingBits\Entities\WriteProtectTab;

class MyEntity extends WriteProtectedEntity
{
    // provides all the methods of WriteProtectedEntity
    use WriteProtectTab;

    public function __construct($name)
    {
        // remember the name
        $this->name = $name;

        // all done
        $this->setReadOnly();
    }
}
```

### Enforcing Write-Protection

In your object's `setXXX()` methods, always call `$this->requireReadWrite()` before changing data. If `$this->isReadOnly()` returns `true`, `$this->requireReadWrite()` will throw a `ReadOnlyException` for you:

```php
use GanbaroDigital\MissingBits\Entities\ReadOnlyException;
use GanbaroDigital\MissingBits\Entities\WriteProtectedEntity;
use GanbaroDigital\MissingBits\Entities\WriteProtectTab;

class MyEntity extends WriteProtectedEntity
{
    use WriteProtectTab;

    public function setName($name)
    {
        // are we write-protected atm?
        $this->requireReadWrite();

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
* [`WriteProtectedEntity`](WriteProtectedEntity.html) - interface implemented by entities that are read-only after construction
