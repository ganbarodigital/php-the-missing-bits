# Entity

{% include ".i/since/1.10.0.twig" %}

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

{% include ".i/supports/5.6-7.x.twig" %}
