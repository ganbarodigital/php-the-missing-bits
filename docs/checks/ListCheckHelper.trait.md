# ListCheckHelper trait

{% include ".i/since/1.10.0.twig" %}

## Description

`ListCheckHelper` is a trait. It implements the `inspectList()` method of the [`ListCheck`](ListCheck.class.html) interface for you.

Using the trait:

* saves you having to create the `inspectList()` method everywhere
* gives you the same error checking everywhere

## Public Interface

`ListCheckHelper` has the following public interface:

```php
// ListCheckHelper lives in this namespace
namespace GanbaroDigital\MissingBits\Checks;

use InvalidArgumentException;

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

    /**
     * make sure we are looking at a list
     *
     * @param  mixed $list
     *         the list of data to be type-checked
     * @return void
     *
     * @throws InvalidArgumentException
     *         if $list isn't something we can iterate over
     */
    protected function requireList($list);
}
```

## How To Use

### For Convenience

Use `ListCheckHelper` in your own classes to save on typing and code duplication.

See [`ListCheck`](ListCheck.class.html) for details.

## Trait Contract

Here is the contract for this trait:

    GanbaroDigital\MissingBits\Checks\ListCheckHelper
     [x] can instantiate class that uses trait
     [x] is part of ListCheck interface
     [x] can inspect an array of data via inspectList
     [x] can inspect a Traversable object via inspectList
     [x] can inspect a stdClass object via inspectList
     [x] throws InvalidArgumentException when non list passed to inspectList

{% include ".i/boilerplate/trait-contract.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}

## See Also

* [`ListCheck` interface](ListCheck.class.html)