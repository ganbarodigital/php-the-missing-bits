# CanBeEmpty interface

<div class="callout info">
Since v1.6.0
</div>

## Description

`CanBeEmpty` is an interface. Implement this interface if your object can answer the question "is it empty?".

## Public Interface

`CanBeEmpty` has the following public interface:

```php
// CanBeEmpty lives in this namespace
namespace GanbaroDigital\MissingBits\TypeInterfaces;

/**
 * for objects that can answer the question: 'are you empty'?
 */
interface CanBeEmpty
{
    /**
     * returns true if the object should be considered as 'empty'
     *
     * empty might include:
     * - never initialised
     * - data container, has no data
     * - data container, contains only empty data
     *
     * @return boolean
     */
    public function isEmpty();
}
```

## Notes

None at this time.
