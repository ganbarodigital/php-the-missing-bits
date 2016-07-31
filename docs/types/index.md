---
currentSection: types
currentItem: home
pageflow_next_url: GetArrayTypes.html
pageflow_next_text: GetArrayTypes class
---

# Type Functions and Classes

## Introduction

Here's a list of what we find is missing from PHP's built-in support for data types.

## Type Inspectors

These classes provide information about

* a variable's duck types or strict types
* a class's parents, traits, and namespace

Click on the class below for more details.

Class | Purpose
------|--------
[`GetArrayTypes`](GetArrayTypes.html) | returns a list of all strict PHP types for a given array
[`GetClassTraits`](GetClassTraits.html) | returns a list of all traits used by a class or object, its parents, and its traits
[`GetClassTypes`](GetClassTypes.html) | returns a list of all strict PHP types for a given class or interface
[`GetDuckTypes`](GetDuckTypes.html) | returns a list of all practical PHP types for a given value or variable
[`GetObjectTypes`](GetObjectTypes.html) | returns a list of all strict PHP types for a given object
[`GetNamespace`](GetNamespace.html) | returns a class's or object's namespace
[`GetNumericType`](GetNumericType.html) | returns which PHP `integer` or `double` a given value might be
[`GetPrintableType`](GetPrintableType.html) | `gettype()` for error logging / exception messages
[`GetStrictTypes`](GetStrictTypes.html) | returns a list of all strict PHP types for a given value or variable
[`GetStringDuckTypes`](GetStringDuckTypes.html) | returns a list of all PHP duck types for a given string
[`GetStringTypes`](GetStringTypes.html) | returns a list of all strict PHP types for a given string
[`is_stringy`](is_stringy.html) | can we use the variable as a string?
[`StripNamespace`](StripNamespace.html) | returns a class's or object's classname without the namespace

## Type Interfaces

These interfaces provide:

* ways to convert an object to built-in PHP data types
* ways to inspect an object just like you'd inspect built-in PHP data types

Click on the interface below for more details.

Interface | Purpose
----------|--------
[`CanBeEmpty`](CanBeEmpty.html) | adds `isEmpty()` to an object
[`Listable`](Listable.html) | adds `toArray()` to an object
[`Logical`](Logical.html) | adds `isTrue()` to an object
