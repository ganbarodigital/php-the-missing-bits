---
currentSection: types
currentItem: Listable
pageflow_prev_url: CanBeEmpty.html
pageflow_prev_text: CanBeEmpty interface
pageflow_next_url: Logical.html
pageflow_next_text: Logical interface
---

# Listable

<div class="callout info">
Since v1.6.0
</div>

## Description

`Listable` is an interface. Implement this interface if your object can convert its contents into a standard PHP array.

## Public Interface

`Listable` has the following public interface:

```php
// Listable lives in this namespace
namespace GanbaroDigital\MissingBits\TypeInterfaces;

/**
 * for objects that can turn themselves into a PHP array
 */
interface Listable
{
    /**
     * returns the contents of the object as a standard PHP array
     *
     * @return array
     */
    public function toArray();
}
```

## Notes

None at this time

{% include ".i/supports/5.6-7.x.twig" %}
