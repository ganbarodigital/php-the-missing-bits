---
currentSection: types
currentItem: home
pageflow_next_url: GetArrayTypes.html
pageflow_next_text: GetArrayTypes class
---

# Type Functions and Classes

## Introduction

Here's a list of what we find is missing from PHP's built-in support for data types.

## Type Checks

These functions and classes provide a way to check for common data types.

Click on the function or class below for more details.

Here's the list of global functions you can use for inspecting types:

Function | Purpose
---------|--------
[`is_list`](IsList.html) | can we use the variable in foreach() loop?
[`is_listy_object`](IsListyObject.html) | can we use the variable in foreach() loop?
[`is_stringy`](IsStringy.html) | can we use the variable as a string?

Here's the list of classes you can use for inspecting types:

Class | Purpose
------|--------
[`IsArray`](IsArray.html) | can we use the variable with PHP's `array_xxx` functions?
[`IsList`](IsList.html) | can we use the variable in foreach() loop?
[`IsListyObject`](IsListyObject.html) | can we use the variable in foreach() loop?
[`IsStringy`](IsStringy.html) | can we use the variable as a string?


## Type Inspectors

These functions and classes provide information about

* a variable's duck types or strict types
* a class's parents, traits, and namespace

Click on the function or class below for more details.

Here's the list of global functions you can use for inspecting types:

Function | Purpose
---------|--------
[`get_array_types`](GetArrayTypes.html) | returns a list of all strict PHP types for a given array
[`get_class_traits`](GetClassTraits.html) | returns a list of all traits used by a class or object, its parents, and its traits
[`get_class_types`](GetClassTypes.html) | returns a list of all strict PHP types for a given class or interface
[`get_duck_types`](GetDuckTypes.html) | returns a list of all practical PHP types for a given value or variable
[`get_namespace`](GetNamespace.html) | returns a class's or object's namespace
[`get_numeric_type`](GetNumericType.html) | returns which PHP `integer` or `double` a given value might be
[`get_object_types`](GetObjectTypes.html) | returns a list of all strict PHP types for a given object
[`get_printable_type`](GetPrintableType.html) | `gettype()` for error logging / exception messages
[`get_strict_types`](GetStrictTypes.html) | returns a list of all strict PHP types for a given value or variable
[`get_string_duck_types`](GetStringDuckTypes.html) | returns a list of all PHP duck types for a given string
[`get_string_types`](GetStringTypes.html) | returns a list of all strict PHP types for a given string
[`strip_namespace`](StripNamespace.html) | returns a class's or object's classname without the namespace

Here's the list of classes you can use for inspecting types:

Class | Purpose
------|--------
[`GetArrayTypes`](GetArrayTypes.html) | returns a list of all strict PHP types for a given array
[`GetClassTraits`](GetClassTraits.html) | returns a list of all traits used by a class or object, its parents, and its traits
[`GetClassTypes`](GetClassTypes.html) | returns a list of all strict PHP types for a given class or interface
[`GetDuckTypes`](GetDuckTypes.html) | returns a list of all practical PHP types for a given value or variable
[`GetNamespace`](GetNamespace.html) | returns a class's or object's namespace
[`GetNumericType`](GetNumericType.html) | returns which PHP `integer` or `double` a given value might be
[`GetObjectTypes`](GetObjectTypes.html) | returns a list of all strict PHP types for a given object
[`GetPrintableType`](GetPrintableType.html) | `gettype()` for error logging / exception messages
[`GetStrictTypes`](GetStrictTypes.html) | returns a list of all strict PHP types for a given value or variable
[`GetStringDuckTypes`](GetStringDuckTypes.html) | returns a list of all PHP duck types for a given string
[`GetStringTypes`](GetStringTypes.html) | returns a list of all strict PHP types for a given string
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
