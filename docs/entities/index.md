---
currentSection: entities
currentItem: home
pageflow_next_url: ReadOnlyException.html
pageflow_next_text: ReadOnlyException class
---

# Entities

## Introduction

Entities are objects that:

* hold data, and
* support changing that data after construction (normally via `setXXX()` methods)

Here's a list of what we feel is missing from PHP's built-in support for entities.

## Available Exceptions

Exception | Description
----------|------------
[`ReadOnlyException`](ReadOnlyException.html) | thrown when attempting to edit an entity that is write-protected

## Available Interfaces

Interface | Description
----------|------------
[`WriteProtectableEntity`](WriteProtectableEntity.html) | entities that can be switched into read-only mode
[`WriteProtectedEntity`](WriteProtectedEntity.html) | entities that switch into read-only mode after construction

## Available Traits

Trait | Description
------|------------
[`WriteProtectTab`](WriteProtectTab.html) | simple implementation of the `WriteProtectableEntity` interface
