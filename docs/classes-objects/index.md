---
currentSection: classes-objects
currentItem: home
pageflow_next_url: get_class_properties.html
pageflow_next_text: get_class_properties()
---

# Classes and Objects

## Introduction

Here's a list of what we find is missing from PHP's built-in support for working with objects.

## Available Functions

### Class Functions

Function | Purpose
---------|--------
[`get_class_properties()`](get_class_properties.html) | return the static properties of a class
[`has_class_properties()`](has_class_properties.html) | does the class have static properties at all?

### Object Functions

Function | Purpose
---------|--------
[`has_object_properties()`](has_object_properties.html) | does the object have non-static properties at all?

## Available Classes

### For Working With Classes

Class | Purpose
------| -------
[`FilterClassProperties`](FilterClassProperties.html) | extract the static properties of a class
[`HasClassProperties`](HasClassProperties.html) | does the class have static properties?
[`IsClassProperty`](IsClassProperty.html) | is the [`ReflectionProperty`](http://www.php.net/ReflectionProperty) a class property?

### For Working With Objects

Class | Purpose
------|--------
[`FilterObjectProperties`](FilterObjectProperties.html) | extract the non-static properties of an object
[`HasObjectProperties`](HasObjectProperties.html) | does the object have non-static properties?
[`IsObjectProperty`](IsObjectProperty.html) | is the [`ReflectionProperty`](http://www.php.net/ReflectionProperty) an object property?

### Utilities

Class | Purpose
------|--------
[`FilterProperties`](FilterProperties.html) | return a filtered list of a class's or object's properties
[`HasFilteredProperties`](HasProperties.html) | does a class or object have properties that pass a user-supplied filter?
