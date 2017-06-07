# Errors

{% include ".i/since/1.10.0.twig" %}

## What's Included?

This shim backports some of PHP 7's new runtime engine Errors for PHP 5 users.

Included | Original Docs
---------|--------------
`Throwable` | [http://php.net/manual/en/class.throwable.php](http://php.net/manual/en/class.throwable.php)
`Error` | [http://php.net/manual/en/class.error.php](http://php.net/manual/en/class.error.php)
`TypeError` | [http://php.net/manual/en/class.typeerror.php](http://php.net/manual/en/class.typeerror.php)

<div class="callout attention" markdown="1">
This shim only activates if you're using PHP 5.x.
</div>

## Why Have We Included These?

Here's why we've added this shim.

1. Robustness - Input Type Checking

   If your code is using type hints, PHP 7 and onwards will throw `TypeError` if you pass an incompatible argument to a function or a method.

   Language-supported type hints aren't always able to express the range of types that a function or method can legally accept. Runtime checks are still necessary to plug the gaps. As the language supports richer type hints in future, runtime checks can be phased out when that happens.

   Before PHP 7, standard practice was for these runtime checks to throw the older SPL `IllegalArgumentException`. If we use `IllegalArgumentException` in _PHP: The Missing Bits_, we'll be forcing you to have to check for both `IllegalArgumentException` and `TypeError`. We're not happy with that.

   _PHP: The Missing Bits_ will throw `TypeError` where appropriate from its runtime checks. This shim makes that possible for anyone who still needs to use PHP 5.x, and doesn't affect anyone already using PHP 7 onwards.

{% include ".i/supports/5.6-7.x.twig" %}
