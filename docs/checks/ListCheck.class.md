# ListCheck interface

{% include ".i/since/1.10.0.twig" %}

## Description

`ListCheck` is an interface. It's the interface for `true` / `false` inspections of a list of data.

<div class="callout info" markdown="1">
#### What's The Difference Between A Check, And Assurances / Requirements?

Checks are _questions_, Assurances and Requirements are _quality inspections_.

Checks are `IsXXX()`-type calls. Their job is to look at your data, and say if your data "is" something or not. For example, `IsStringy()` will tell you if your data can be used as a string or not. It isn't necessarily an error if a check returns `false`. That's why checks never throw exceptions.

Assurances and Requirements are looking at your data to make sure everything is okay. For example, `RequireStringy()` makes sure that your data can be used as a string. A failed Assurance or Requirement is treated as an error, complete with exceptions thrown and dreams dashed.

It's good practice for your Assurances and Requirements to be built on top of your Checks wherever possible.

_The interfaces for Assurances and Requirements can be found in Ganbaro Digital's [Defensive Library](https://ganbarodigital.github.io/php-mv-defensive/)._
</div>

## Public Interface

`ListCheck` has the following public interface:

```php
// ListCheck lives in this namespace
namespace GanbaroDigital\MissingBits\Checks;

interface ListCheck
{
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

    /**
     * does a list of values pass inspection?
     *
     * @param  mixed $list
     *         the data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public function inspectList($list);
}
```

`ListCheck` also has the following informal interface:

```php
interface ListCheck
{
    /**
     * create a customised Check, ready to be used
     *
     * @return ListCheck
     */
    public static function using(<customisation params>);

    /**
     * does a value pass inspection?
     *
     * @param  mixed $fieldOrVar
     *         the data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public static function check($fieldOrVar, <additional params>);

    /**
     * does a list of values pass inspection?
     *
     * @param  mixed $list
     *         the data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     */
    public static function checkList($list, <additional params>);
}
```

_Informal interfaces_ contain methods that you must implement. However, due to PHP limitations, we can't add these methods to the `interface` at this time.

## How To Build A ListCheck

Every `ListCheck` can be used in two ways:

* a static call to `::checkList()` for convenience,
* as an object, calling the `->inspectList()` method

### Step 1: Build A Check

Start off by implementing [the `Check` interface](Check.class.html) first. Re-using that saves us a lot of duplication and effort!

Here's a working `IsInRange` check:

{% include ".i/examples/Check/IsInRange.inc.twig" %}

### Step 2: Implement ListCheck

Extend your existing Check into a ListCheck by:

* add `use GanbaroDigital\MissingBits\Checks\ListCheck` to your PHP file
* add `use GanbaroDigital\MissingBits\Checks\ListCheckHelper` to your PHP file
* add `implements ListCheck` to your class
* add `use ListCheckHelper` to your class
* add a `pubilc static checkList()` method to your class

The `checkList()` method simply calls `inspectList()` on a temporary object.

Here's what the `IsInRange` check looks like after we've done all of that:

{% include ".i/examples/ListCheck/IsInRange.inc.twig" %}

Hopefully, you can see that it doesn't take much effort to do.

<div class="callout info" markdown="1">
#### Check Seems Backwards To ListCheck?

You may have noticed that `Check` and `ListCheck` are implemented in the exact opposite way to each other:

* With the `Check` interface, your object's `inspect()` method calls the static `check()` method.
* With the `ListCheck` interface, your object's static `checkList()` method creates a temporary object, and calls its `inspectList()` method.

Why is this?

We wanted to use traits to reduce the amount of code that you have to duplicate. We can only use traits where a method's parameters and internal code can be standardised.

* There's nothing in the `Check` interface that fits in a trait. Every line of code is unique to each `Check`.
* A `ListCheck` is a bit different. At some point, every `ListCheck` needs to iterate over a list, checking its contents as it goes along. (It's also a good idea if each `ListCheck` makes sure it's looking at a list to begin with!)

We don't want to repeat that code over every single `ListCheck` that we write. If we do repeat that code over an over, mistakes and inconsistencies *will* creep in over time. PHP traits were invented to solve this exact problem. But how can we do it?

* We can't put `checkList()` into a trait. It's parameters are unique to each `ListCheck` implementation class.
* `inspectList()` can go into a trait. It's parameters are the same (a single list), and it's behaviour is the same (check everything in the list).
* If we make `checkList()` call `inspectList()`, we avoid duplicating any of the code in `inspectList()`.

That's how we ended up with `Check` implemented one way, and `ListCheck` implemented the other way.
</div>

## How To Use A ListCheck

Every `ListCheck` can be used in two ways:

* a static call to `::checkList()` for convenience,
* as an object, calling the `->inspectList()` method

Here's our example simple min / max check again.

{% include ".i/examples/ListCheck/IsInRange.inc.twig" %}

{% include ".i/examples/ListCheck/Example-1--Static-Check.twig" %}
{% include ".i/examples/ListCheck/Example-2--Reusable-Object.twig" %}
{% include ".i/examples/ListCheck/Example-3--Via-Factory-Method.twig" %}

{% include ".i/supports/5.6-7.x.twig" %}

## See Also

* [`ListCheckHelper` trait](ListCheckHelper.trait.html)