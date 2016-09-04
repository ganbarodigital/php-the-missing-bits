---
currentSection: v1
currentItem: checks
pageflow_next_url: Check.html
pageflow_next_text: Check interface
---

# Checks

## Introduction

Checks are utilities for performing `true` / `false` inspections of data.

## Available Interfaces

Interface | Description
------|------------
[`Check`](Check.html) | interface for all checks to implement
[`ListCheck`](ListCheck.html) | interface for all inspections that check lists of data to implement

Click on the name of an interface to see full details.

## Available Traits

Class | Description
------|------------
[`ListCheckHelper`](ListCheckHelper.html) | convenience trait to provide the `inspectList()` method of the `ListCheck` interface

Click on the name of a trait to see full details.

## Available Checks

Individual checks don't live in the `GanbaroDigital\MissingBits\Checks` namespace. They can be found in various namespaces across this project.

Class | Description
------|------------
[`IsClassProperty`](../classes-objects/IsClassProperty.html) | is the [`ReflectionProperty`](http://www.php.net/ReflectionProperty) a class property?
[`IsList`](../types/IsList.html) | can we use the variable in foreach() loop?
[`IsListyObject`](../types/IsListyObject.html) | can we use the variable in foreach() loop?
[`IsObjectProperty`](../classes/objects/IsObjectProperty.html) | is the [`ReflectionProperty`](http://www.php.net/ReflectionProperty) an object property?
[`IsStringy`](../types/IsStringy.html) | can we use the variable as a string?
