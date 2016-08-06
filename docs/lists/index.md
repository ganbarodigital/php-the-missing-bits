---
currentSection: lists
currentItem: home
pageflow_next_url: TraverseArray.html
pageflow_next_text: TraverseArray
---

# List Functions

## Introduction

Lists are any PHP data type that can safely be used in a `foreach()` loop:

* PHP arrays
* `Traversable` objects (iterators, generators and the like)
* PHP objects with public properties

Here's a list of what we find is missing from PHP's built-in support for lists.

## Available Functions

Function | Purpose
---------|--------
[`traverse_array`](TraverseArray.html) | iterate over an array
[`traverse_list`](TraverseList.html) | iterate over anything that `foreach()` will accept
[`traverse_object`](TraverseObject.html) | iterate over the public properties of any object

Click on a function name for more details.

## Available Classes

Class | Purpose
------|--------
[`TraverseArray`](TraverseArray.html) | iterate over an array
[`TraverseList`](TraverseList.html) | iterate over anything that `foreach()` will accept
[`TraverseObject`](TraverseObject.html) | iterate over the public properties of any object
