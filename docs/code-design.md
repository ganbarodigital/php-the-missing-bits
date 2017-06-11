# Code Design

## Summary

Our code design checklist:

* separate out behaviour and state into different classes
  * behaviour into stateless classes with _customised behaviour_
  * state into entities (read-write) or values (read-only)
* behaviour classes:
  * one single static method for _direct static access_
  * one single standardised method for _composability_
  * add `::__construct()` for _customised behaviour_
  * add `::using()` for _fluent interface_
  * provide global function as a convenience wrapper & bridge to the non-OO programming community

How did we get to this list ...?

## Introduction

Many of the classes in _PHP: The Missing Bits_ simultaneously support:

1. being used to create traditional objects, and
1. direct `class::method()` static access too

What's the thinking behind that?

It delivers both convenience (via the direct static access), and the power of reusable behaviour (via objects), also known as _composability_, to suit the situation.

## Single Responsibility Principle

Whether it's:

* applying a filter to a value
* editing an existing value
* inspecting a value

many of the classes in _PHP: The Missing Bits_ do one thing, and one thing only. This is known as the _single responsibility principle_.

This allows us to expose the class's functionality:

* via a single method, and
* as a convenient global function

For example, if we want a way to check for [a list](types/IsList.class.html), we can provide:

* [`IsList::check()`](types/IsList.check.html) and
* [`check_is_list()`](types/check_is_list.html)

You'd call them like this:

```php
// direct static access
var_dump(IsList::check($fieldOrVar));

// global convenience function
var_dump(check_is_list($fieldOrVar));
```

Internally, convenience functions like `check_is_list()` simply call the corresponding class's static method, and return the results. They're there for anyone who prefers using global functions.

<div class="callout attention" markdown="1">
#### Direct Static Access !== Singletons

A _singleton_ is a class or object that:

* holds state, and
* deliberately uses the exact same state even in multiple objects

The classes in _PHP: The Missing Bits_ that support direct static access aren't singletons. They're functions. They don't hold state of their own.

What we're doing here is taking an older programming paradigm - _modular programming_ - and achieving it using the object-oriented syntax that's available today.

So don't worry. By using our code, you're not suddenly using singletons throughout your application or library.
</div>

## Composability

There are several aspects to _composability_:

* reusable objects (with customised behaviour)
* interchangeable objects (through standardised methods)
* concatenable objects (benefit of reusable and interchangeable objects)

### Reusability and Customisation

_Reusability_ allows us to create an object once, and then apply its behaviour multiple times to different data:

```php
// we want to know if we have an entity or not
$check = new IsObjectOfType(Entity::class);

// is $data1 an entity?
var_dump($check->inspect($data1));

// is $data2 an entity too?
// we can reuse $check to find out
var_dump($check->inspect($data2));
```

The parameters to the object's constructor _customise_ the object's behaviour. In our example above, we are creating an object that will return `true` if and only if it sees an `Entity`. We can then re-use that object to check for entities multiple times.

These _customisation parameters_ are the only properties that _reusable_ objects store internally.

* They're not _entities_ (read-write data stores).
* They're not _values_ (read-only data stores).

Those properties are set via the constructor. There are no setter methods (`setXXX()`) at all.

<div class="callout attention" markdown="1">
#### Separating Behaviour And State Data

A _reusable_ object operates on data passed into it. It doesn't store that data in its own properties at any time.

Embracing _reusability_ means separating out _behaviour_ (the work that the reusable object does) from state (the data stored in an entity, value object, or a PHP variable). The result?

* much smaller classes,
* that are easier to understand,
* that are deterministic,
* that are easier to test,
* that are less likely to break over time,
* and easier to re-use from project to project

You might have been taught that OOP is all about lumping behaviour and state together into the same class definition. It isn't. OOP is about managing access to state, and controlling state changes.

It came about from lessons learned in the 1970s and 1980s, where any code could change any state at any time. This free-for-all approach required a level of programming discipline that just wasn't possible to maintain over time, and across personnel changes on projects.

OOP allows us to write code that effectively puts a firewall around state data. We can centralise the rules regarding who can see the data, what they see, and what they can change.

What we do with that state data - how our app makes business decisions based on that state data - works best if it is separated out into discrete classes of its own.
</div>

_Composability_ takes _reusability_, and makes the objects both _interchangeable_ and _concatenable_.

### Interchangeable

_Interchangeable_ objects can be replaced with other compatible objects, without having to change any code that uses the objects.

There's quite a lot to that statement:

* replaceable objects,
* compatible with each other, and
* no changes needed to code that uses the objects, even when you replace one object with another

Let's explain it through an example.

Most online shops support the idea of applying a discount when calculating the final price for the customer. If you're selling pizzas, the discount might be a voucher code of some kind. If you're selling guitars, the discount might be loyalty points from their previous purchases.

Instead of hard-coding the discount check, you could pass the check into an `apply_discount_when()` function:

```php
function apply_discount_when($customer, $order, $amount, $condition) {
    // does the discount apply?
    if (!$condition->inspect($customer)) {
        return;
    }

    // if we get here, then we should apply the discount
    $order->discounts->apply($amount);
}

// check for pizza vouchers
$check = new HasVoucherCode();
apply_discount_when($customer, $order, 20, $check);

// check for loyalty points
$check = new HasLoyaltyPoints();
apply_discount_when($customer, $order, $customer->loyaltyPoints, $check);
```

We can replace one `$condition` object with another:

* by standardising the method name (`inspect()`), and
* by standardising the parameters that `inspect()` accepts (`$customer`)

The result? _Interchangeable_ objects.

### Concatenable

_Interchangeable_ objects can also be _concatenated together_ into lists.

```php
// selling pizzas, but discounts only apply
// to anyone who picks up their order from
// our store
$checks = [
    new HasWebVoucher(),
    new IsCollection()
];
apply_discount_when($customer, $order, 20, $checks);
```

Then, all we need to do is tweak our `apply_discount_when()` function to check all the conditions first.

```php
function apply_discount_when($customer, $order, $amount, $conditions) {
    // does the discount apply?
    foreach($conditions as $condition) {
        if (!$condition->inspect($customer)) {
            return;
        }
    }

    // if we get here, then we should apply the discount
    $order->discounts->apply($amount);
}
```

The beauty of this is that, one again, we don't need to hard-code all the conditions that must be met before a customer can have a discount. By supporting a list of conditions, our `apply_discount_when()` function has become more flexible.

### Functional Composition

No discussion of composability is complete without mentioning _functional composition_, and the unique problems it can bring to PHP library / framework design.

_Functional composition_ (as a general concept) takes the return value of a function or method, and uses it as the parameter of the next function or method in the list.

In PHP, it might look like this:

```php
function a($input1)
{
    return $input1;
}

function b($input2)
{
    return $input2;
}

// this is functional composition
var_dump(a(b($data)));
```

Functional composition is only possible when you are combining functions that:

* accept compatible input parameter(s)
* return a value that's a compatible type with the input parameter

As a result, _functional composition_ is a subset of all possible _composable_ functions and objects.

It may be a subset, but __functional composition has had a major impact on PHP language design and especially framework design__ since around 2010. We're specifically talking about the `__invoke()` magic method, introduced in PHP 5.3.0 in 2009.

`__invoke()` is a method you can add to a PHP class, to make it act as a function.

```php
class IsList
{
    public function __invoke($fieldOrVar)
    {
        if (is_array($fieldOrVar)) {
            return true;
        }

        return false;
    }
}

// create our reusable object
$check = new IsList();

// thanks to __invoke, we can call it exactly
// the same we can call an anonymous function
var_dump($check($data1));
```

This is, undeniable, incredibly powerful. Adding `__invoke()` means:

* the calling code doesn't need to know what the standardised method names are on objects
* we can interchange invokeable objects, anonymous functions or any other PHP `callable`, as long as they are all compatible with each other

The PHP micro-framework movement in particular grew up around these benefits.

Unfortunately, several years of experience has shown that this is a bit of a mixed bag. There are PHP language limitations, and cognitive challenges for developers.

If we take our checkout example, and go all-in on type-hinting and `__invoke()`, this is what we get:

```php

function apply_discount_when(
    Customer $customer,
    Order $order,
    int $amount,
    callable $condition
)
{
    // ...
}
```

Can you answer these questions?

* What parameters does `$condition` need to accept?
* What data type does it need to return?
* How do we enforce that?

__You can't. And that's the problem.__

* We can't strictly describe `$condition` in this PHP code. We can't say what parameters it needs to accept. Any PHP `callable` can be passed in, and we'll only find out if it's compatible or not when we try to use it.

* There's a flip side to this problem. If we're writing something to pass in as `$condition`, we don't easily know what parameters our function or `__invoke()` needs to accept. We don't know what it needs to return back to the caller.

Build a whole framework around `callable`, use it to write a large app over a period of several years (long enough for people to have come and gone from the project), and the result is:

* code that's badly understood
* code that's slow to work on
* code that's buggy

... simply because PHP `callable` everywhere dramatically reduces how readable your code is. That lesson has been learned, and in 2017 we're seeing PHP frameworks starting to prefer readability over extreme flexibility.

<div class="callout attention" markdown="1">
Code readability directly improves code quality and developer productivity.
</div>

When PHP allows defining a callable's signature + allows type-hinting using that signature, then we'll be better placed to safely use `__invoke()`. Until then, we won't be supporting `__invoke()` in _PHP: The Missing Bits_.

But that doesn't mean we can't support _functional composition_ in a different way for now, and prepare for a future where `__invoke()` can be safely adopted.

For now, we're supporting _functional composition_ by ensuring:

* compatible objects have standardised method names
* standardised method names take a single parameter
* behavioural objects have a single standardised method

This approach is compatible with everything else we're doing with class design. It just adds that extra step of discipline (single standardised method) to make us more future proof.

## Fluent Interface

A _fluent interface_ allows you to chain method calls together. It's a programming style that can feel natural to use and natural to read. (Not everyone finds it natural!)

When you apply the idea to our _composable objects_, you get this:

```php
// fluent interface
//
// ::using() returns a customised object
// which we then call its standardised method
var_dump(IsObjectOfType::using(Entity::class)->inspect($data));
```

That gives us up to four different ways to achieve the same thing:

```php
// convenience function
//
// avoids importing into your PHP file
// might be easier for some devs to understand
var_dump(check_is_object_of_type($data, Entity::class));

// direct static access
//
// fastest, because no object has to be created
var_dump(IsObjectOfType::check($data, Entity::class));

// reusable object
//
// slower than direct access, but allows you to pass
// behaviour around as a parameter to other methods
$check = new IsObjectOfType(Entity::class);
var_dump($check->inspect($data));

// fluent interface
//
// slower than direct access
// avoids declaring a variable in your code
var_dump(IsObjectOfType::using(Entity::class)->inspect($data));
```

All of our classes that support _fluent interfaces_ support the same pattern:

    className::using(<customisation params>)->standardisedMethod($data)

It's there if you prefer it. And if you don't like it as a style, you don't have to use it at all.