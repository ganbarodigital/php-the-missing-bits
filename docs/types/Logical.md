---
currentSection: types
currentItem: Logical
pageflow_prev_url: Listable.html
pageflow_prev_text: Listable interface
---

# Logical

<div class="callout info">
Since v1.6.0
</div>

## Description

`Logical` is an interface. Implement this interface if your object can be either `TRUE` or `FALSE`.

## Public Interface

`Logical` has the following public interface:

```php
// Logical lives in this namespace
namespace GanbaroDigital\MissingBits\TypeInterfaces;

/**
 * for objects that can answer the question: true or false?
 */
interface Logical
{
    /**
     * is this object true or false?
     *
     * @return boolean
     *         TRUE if this object is true
     *         FALSE otherwise
     */
    public function isTrue();
}
```

## Notes

None at this time.
