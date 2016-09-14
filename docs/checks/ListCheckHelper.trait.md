---
currentSection: checks
currentItem: defining-checks
pageflow_prev_url: ListCheck.class.html
pageflow_prev_text: ListCheck interface
---

# ListCheckHelper

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`ListCheckHelper` is a trait. It implements the `inspectList()` method of the [`ListCheck`](ListCheck.class.html) interface for you.

## Public Interface

`ListCheckHelper` has the following public interface:

```php
// ListCheckHelper lives in this namespace
namespace GanbaroDigital\MissingBits\Checks;

trait ListCheckHelper
{
    /**
     * does a list of values pass inspection?
     *
     * @param  mixed $list
     *         the list of data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public function inspectList($list);
}
```

## How To Use

### For Convenience

Use `ListCheckHelper` in your own classes to save on typing and code duplication.

```php
use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\Checks\ListCheckHelper;

class IsInRange implements Check, ListCheck
{
    // save us having to declare inspectList() ourselves
    use ListCheckHelper;

    /**
     * minimum acceptable value in our range
     */
    private $min;

    /**
     * maximum acceptable value in our range
     */
    private $max;

    /**
     * constructor. used to create a customised check
     *
     * @param  int $min
     *         minimum value for allowed range
     * @param  int $max
     *         maximum value for allowed range
     */
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * generates a Check
     *
     * @param  int $min
     *         minimum value for allowed range
     * @param  int $max
     *         maximum value for allowed range
     * @return Check
     *         returns a check to use
     */
    public static function using($min, $max)
    {
        return new static($min, $max);
    }

    /**
     * does a value pass inspection?
     *
     * @param  mixed $fieldOrVar
     *         the data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public function inspect($fieldOrVar);
    {
        if ($fieldOrVar < $this->min) {
            return false;
        }
        if ($fieldOrVar > $this->max) {
        }
    }
}
```

To use this example check, you would do:

```php
$list = [
    25,
    20
];

// every entry in $list must be >=10, and <=20
if (!IsInRange::using(10, 20)->inspectList($list)) {
    // at least one item in the list failed the check
}
```

## Trait Contract

Here is the contract for this trait:

    GanbaroDigital\MissingBits\Checks\ListCheckHelper
     [x] can instantiate class that uses trait
     [x] is part of ListCheck interface
     [x] can inspect an array of data via inspectList
     [x] can inspect a Traversable object via inspectList
     [x] can inspect a stdClass object via inspectList
     [x] throws InvalidArgumentException when non list passed to inspectList

Trait contracts are built from this trait's unit tests.

<div class="callout success">
Future releases of this trait will not break this contract.
</div>

<div class="callout info" markdown="1">
Future releases of this trait may add to this contract. New additions may include:

* clarifying existing behaviour (e.g. stricter contract around input or return types)
* add new behaviours (e.g. extra trait methods)
</div>

<div class="callout warning" markdown="1">
When you use this trait, you can only rely on the behaviours documented by this contract.

If you:

* find other ways to use this trait,
* or depend on behaviours that are not covered by a unit test,
* or depend on undocumented internal states of this trait,

... your code may not work in the future.
</div>

## Notes

None at this time.

## See Also

* [`ListCheck` interface](ListCheck.class.html)
