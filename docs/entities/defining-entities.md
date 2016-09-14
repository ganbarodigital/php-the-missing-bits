---
currentSection: entities
currentItem: defining-entities
pageflow_next_url: ReadOnlyException.class.html
pageflow_next_text: ReadOnlyException class
---

# Defining Entities

## Introduction

We've introduced:

* exceptions
* interfaces
* and traits

to standardise the common behaviour of entities.

## What Is An Entity?

### Properties Of An Entity

An entity is an object that:

* stores one or more items of data
* can be initialised via the constructor
* has one or more `getXXX()` methods to retrieve the stored data
* has one or more `setXXX()` methods to update the stored data
* may have one or more `hasXXX()` methods to see if stored data is available
* may have one or more `isXXX()` methods to inspect its state (although we recommend breaking those out into separate [checks](../checks/index.html) for maximum code re-use)

An entity is a _data object_. The most common example are the objects returned by your object-relational mapper, such as Doctrine. But, in reality, any object with getters and setters is a wannabe entity.

<div class="callout info" markdown="1">
#### Entities vs Value Objects

When it comes to objects that store data, there are two basic code patterns:

* Entities are _mutable by design_. They are read-write objects. You can change the data stored in an entity.
* Value objects are _immutable by design_. They are read-only objects. You can't change the data stored in a value object. If you do want to change the data, you must create a new value object that contains the changed data.

Both patterns have their strengths, and their weaknesses.

A major weakness of entities is the _surprise modification_:

* you pass the entity into another piece of code (possibly written by someone else)
* the entity gets modified whilst inside that piece of code
* but you're unaware (or have forgotten) that the entity is going to get changed

As applications grow in size and complexity, you can end up losing track of whether an entity will be modified or not. This is a real problem for HTTP GET requests - which should always be read-only operations. However, it can happen in any type of HTTP request.

Detailed testing can spot these bugs. However, most test suites don't have sufficient code coverage to do so - or worse, have adopted a _mock everything_ approach which hides the surprise modification from your tests. Switching to value objects is one solution, but it isn't always an option.

As a result, we've added read-only support for entities in _PHP: The Missing Bits_.
</div>

### An Example Entity

Here's an example entity, that implements read-only support:

```php
use GanbaroDigital\MissingBits\Entities\WriteProtectedEntity;
use GanbaroDigital\MissingBits\Entities\WriteProtectTab;

/**
 * an example entity
 */
class MyEntity implements WriteProtectableEntity
{
    /**
     * data stored in the entity
     */
    private $foo;

    /**
     * another bit of data stored in the entity
     */
    private $bar;

    // adds helpers for read-only support
    use WriteProtectTab;

    /**
     * initialise this entity
     */
    public function __construct($foo, $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }

    /**
     * get 'foo' from this entity
     */
    public function getFoo()
    {
        return $this->foo;
    }

    /**
     * store a new value for 'foo'
     *
     * @throws ReadOnlyException
     */
    public function setFoo($newFoo)
    {
        $this->requireReadWrite();
        $this->foo = $newFoo;
    }

    /**
     * get 'bar' from this entity
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * store a new value for 'bar'
     *
     * @throws ReadOnlyException
     */
    public function setBar($newBar)
    {
        $this->requireReadWrite();
        $this->bar = $newBar;
    }
}
```

You can use this entity as normal:

```php
// create the entity
$entity = new MyEntity('a piece', 'of data');

// get values from the entity
var_dump($entity->getFoo());
var_dump($entity->getBar());

// store new values in the entity
$entity->setFoo('a new piece');
$entity->setBar('of different data');
```

Only now, we can make the entity read-only at any time:

```php
// create the entity
$entity = new MyEntity('a piece', 'of data');

// make the entity read-only
$entity->setReadOnly();

// this will now throw an exception
$entity->setFoo('a new piece');
```

How does that work? Every setter in the entity calls `$this->requireReadWrite()` first. If the entity is set to read-only, a `ReadOnlyException` will automatically be thrown.

You can take advantage of this in HTTP GET request handlers:

* load your entities
* mark them as read-only after loading
* pass them around your app

If any code elsewhere in your app attempts to modify the entity, you'll get a `ReadOnlyException`.

This entity also has several useful methods for querying and changing the read-only mode:

Function | Description
---------|------------
`$entity->setReadOnly()` | make the entity read-only
`$entity->setReadOnlyForever()` | make it impossible to switch the entity back into read-write mode
`$entity->setReadWrite()` | make the entity read-write again
`$entity->isReadOnly()` | will the entity throw exceptions if we try to modify it?
`$entity->isReadWrite()` | can the entity be modified?

## Available Exceptions

Exception | Description
----------|------------
[`ReadOnlyException`](ReadOnlyException.class.html) | thrown when attempting to edit an entity that is write-protected
[`ReadOnlyForeverException`](ReadOnlyForeverException.class.html) | thrown when attempting to make an entity read-write when that is not allowed

## Available Interfaces

Interface | Description
----------|------------
[`WriteProtectableEntity`](WriteProtectableEntity.class.html) | entities that can be switched into read-only mode
[`WriteProtectedEntity`](WriteProtectedEntity.class.html) | entities that switch into read-only mode after construction

## Available Traits

Trait | Description
------|------------
[`WriteProtectTab`](WriteProtectTab.trait.html) | simple implementation of the `WriteProtectableEntity` interface
