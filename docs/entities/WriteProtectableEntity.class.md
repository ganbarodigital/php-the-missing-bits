# WriteProtectableEntity

<div class="callout info">
Since v1.2.0
</div>

## Description

`WriteProtectableEntity` is an interface. It is implemented by all entities that support being switched into a read-only mode.

## Public Interface

`WriteProtectableEntity` has the following public interface:

```php
// `WriteProtectableEntity` lives in this namespace
namespace GanbaroDigital\MissingBits\Entities;

// our base classes and interfaces
use GanbaroDigital\MissingBits\Entities\Entity;

// the exceptions we throw
use GanbaroDigital\MissingBits\Entities\ReadOnlyForeverException;

interface WriteProtectableEntity extends Entity
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
     * you can re-enable editing this entity by calling ::setReadWrite()
     *
     * @return void
     */
    public function setReadOnly();

    /**
     * disable editing this entity forever
     *
     * after calling this method, any attempt to call ::setReadWrite() will
     * cause a ReadOnlyForever exception
     *
     * @return void
     */
    public function setReadOnlyForever();

    /**
     * enable editing this entity
     *
     * @throws ReadOnlyForeverException
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

## Changelog

### v1.10.0

* Added 'read-only forever' mode
  - added `setReadOnlyForever()` method
  - `setReadWrite()` now throws a `ReadOnlyForeverException` if `setReadOnlyForever()` has been called

## See Also

* [`ReadOnlyException`](ReadOnlyException.class.html) - exception thrown when attempting to edit a read-only entity
* [`ReadOnlyForeverException`](ReadOnlyForeverException.class.html) - exception thrown when attempting to make an entity read-write when that is not allowed
* [`Entity`](Entity.class.html) - empty interface for type-hinting or strict type declarations
* [`WriteProtectedEntity`](WriteProtectedEntity.class.html) - interface implemented by entities that are read-only after construction
* [`WriteProtectTab`](WriteProtectTab.class.html) - simple implementation of the `WriteProtectableEntity` interface, as a trait
