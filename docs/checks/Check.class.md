# Check interface

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`Check` is an interface. It's the interface for `true` / `false` inspections of data.

<div class="callout info" markdown="1">
#### What's The Difference Between A Check, And Assurances / Requirements?

Checks are _questions_, Assurances and Requirements are _quality inspections_.

Checks are `IsXXX()`-type calls. Their job is to look at your data, and say if your data "is" something or not. For example, `IsStringy()` will tell you if your data can be used as a string or not. It isn't necessarily an error if a check returns `false`. That's why checks never throw exceptions.

Assurances and Requirements are looking at your data to make sure everything is okay. For example, `RequireStringy()` makes sure that your data can be used as a string. A failed Assurance or Requirement is treated as an error, complete with exceptions thrown and dreams dashed.

It's good practice for your Assurances and Requirements to be built on top of your Checks wherever possible.

_The interfaces for Assurances and Requirements can be found in Ganbaro Digital's [Defensive Library](https://ganbarodigital.github.io/php-mv-defensive/)._
</div>

## Public Interface

`Check` has the following public interface:

```php
// Check lives in this namespace
namespace GanbaroDigital\MissingBits\Checks;

interface Check
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
}
```

`Check` also has the following informal interface:

```php
interface Check
{
    /**
     * fluent-interface entry point
     *
     * create a customised Check, ready to be used
     *
     * @return Check
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
}
```

{% include ".i/boilerplate/informal-interfaces.twig" %}

## How To Use

Every `Check` can be used in three ways:

* a static call to `::check()` (_direct static access_),
* as a temporary object, calling the `::using()->inspect()` _fluent interface_,
* or as a reusable object, calling the `->inspect()` method

There should be a global function too that acts as a wrapper around `::check()`. These offer convenience, and act as a bridge to the non-OOP community.

See [Code Design](../code-design.html) to learn more about why Checks (and indeed, many other classes in _PHP: The Missing Bits_) can be used in all these different ways.

### Step 1: Scaffolding

Every Check starts with a bit of boilerplate code:

* add `use GanbaroDigital\MissingBits\Checks\Check` to your PHP file
* add `implements Check` to your class

For example:

```php
<?php

use GanbaroDigital\MissingBits\Checks\Check;

class IsInRange implements Check
{

}
```

### Step 2: Direct Static Access

Every `Check` implements the `Check::check()` to support _direct static access_:

* add a `public static function check()` method to your class. This method inspects `$fieldOrVar`. If you're happy with `$fieldOrVar`, return `true`. If you're not happy with `$data`, return `false`.
* if your check needs additional input parameters, pass these in as additional parameters to the `check()` method.

For example:

```php
<?php

use GanbaroDigital\MissingBits\Checks\Check;

class IsInRange implements Check
{
    //
    // ------------ NEW BIT ! ----------------------
    //

    /**
     * is $data within the require range?
     *
     * @param  int $data
     *         the value to check
     * @param  int $min
     *         minimum value for allowed range
     * @param  int $max
     *         maximum value for allowed range
     * @return bool
     *         TRUE if the data is in range
     *         FALSE otherwise
     */
    public static function check($data, $min, $max)
    {
        if ($data < $min) {
            return false;
        }
        if ($data > $max) {
            return false;
        }

        return true;
    }
}
```

### Step 3: Making It Usable As An Object

Every `Check` can be used as an object:

* add a `public function __construct()` if your check needs additional input parameters
* add a `public function inspect()` which calls your static `::check()` method

For example:

```php
<?php

use GanbaroDigital\MissingBits\Checks\Check;

class IsInRange implements Check
{
    //
    // ------------ NEW BIT ! ----------------------
    //

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
     * is $data within the require range?
     *
     * @param  int $data
     *         the value to check
     * @return bool
     *         TRUE if the data is in range
     *         FALSE otherwise
     */
    public function inspect($data)
    {
        return static::check($data, $this->min, $this->max);
    }

    //
    // ------------ OLD BIT ! ----------------------
    //

    /**
     * is $data within the require range?
     *
     * @param  int $data
     *         the value to check
     * @param  int $min
     *         minimum value for allowed range
     * @param  int $max
     *         maximum value for allowed range
     * @return bool
     *         TRUE if the data is in range
     *         FALSE otherwise
     */
    public static function check($data, $min, $max)
    {
        if ($data < $min) {
            return false;
        }
        if ($data > $max) {
            return false;
        }

        return true;
    }
}
```

### Step 4: Supporting The Fluent Interface

Every `Check` supports a fluent interface:

* add a `public static function using()`, which takes the same parameters as your `__construct()`

For example:

```php
<?php

use GanbaroDigital\MissingBits\Checks\Check;

class IsInRange implements Check
{
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

    //
    // ------------ NEW BIT ! ----------------------
    //

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

    //
    // ------------ OLD BIT ! ----------------------
    //

    /**
     * is $data within the require range?
     *
     * @param  int $data
     *         the value to check
     * @return bool
     *         TRUE if the data is in range
     *         FALSE otherwise
     */
    public function inspect($data)
    {
        return static::check($data, $this->min, $this->max);
    }

    /**
     * is $data within the require range?
     *
     * @param  int $data
     *         the value to check
     * @param  int $min
     *         minimum value for allowed range
     * @param  int $max
     *         maximum value for allowed range
     * @return bool
     *         TRUE if the data is in range
     *         FALSE otherwise
     */
    public static function check($data, $min, $max)
    {
        if ($data < $min) {
            return false;
        }
        if ($data > $max) {
            return false;
        }

        return true;
    }
}
```

## Putting It All Together

Here's a simple min / max check. It supports all the different ways that a Check can be used.

{% include ".i/examples/Check/IsInRange.inc.twig" %}

{{ include (".i/examples/Check/Example-1--Direct-Static-Access.twig") }}
{{ include (".i/examples/Check/Example-2--Reusable-Object.twig") }}
{{ include (".i/examples/Check/Example-3--Fluent-Interface.twig") }}

{{ include (".i/supports/5.6-7.x.twig") }}
