---
currentSection: entities
currentItem: defining-entities
pageflow_prev_url: ReadOnlyForeverException.class.html
pageflow_prev_text: ReadOnlyForeverException class
pageflow_next_url: WriteProtectableEntity.class.html
pageflow_next_text: WriteProtectableEntity interface
---

# Entity

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`Entity` is an interface. Use it to help with type-hinting or strict type declarations.

## Public Interface

`Entity` has the following public interface:

```php
// `Entity` lives in this namespace
namespace GanbaroDigital\MissingBits\Entities;

interface Entity
{
}
```

## How To Use

### Implementing This Interface

```php
use GanbaroDigital\MissingBits\Entities\Entity;

class MyEntity extends Entity
{
    // add your getters and setters here
}
```

## Notes

None at this time.
