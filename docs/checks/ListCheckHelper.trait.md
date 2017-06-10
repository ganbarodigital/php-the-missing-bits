# ListCheckHelper trait

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

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

{% include ".i/contracts/GanbaroDigital/MissingBits/Checks/ListCheckHelper.twig" %}
{% include ".i/supports/5.6-7.x.twig" %}

## See Also

* [`ListCheck` interface](ListCheck.class.html)