---
currentSection: overview
currentItem: changelog
pageflow_prev_url: installation.html
pageflow_prev_text: Installation
pageflow_next_url: contributing.html
pageflow_next_text: Contributing
---
# CHANGELOG

## develop branch

### New

* Added support for inspecting class, interface, trait and object names
  - added `GetNamespace`
  - added `StripNamespace`
* Added support for working with PHP stack traces
  - added `FilterBacktrace`
  - added `GetCaller`
  - added `get_caller()`
  - added `get_caller_from_trace()`
  - added `StackFrame`

## v1.3.0

Released Sunday 22nd May 2016.

### New

* Added a richer set of type inspectors, based on code originally from `ganbarodigital/php-defensive`
  - added `GetArrayTypes`
  - added `GetClassTraits`
  - added `GetClassTypes`
  - added `GetDuckTypes`
  - added `GetObjectTypes`
  - added `GetNumericType`
  - added `GetStrictTypes`
  - added `GetStringTypes`

## v1.2.0

Released Monday 9th May 2016.

### New

* Added support for entities that can switch between a read-only mode and read-write
  - Added `ReadOnlyException`
  - Added `WriteProtectableEntity` interface
  - Added `WriteProtectedEntity` interface
  - Added `WriteProtectTab` trait

## v1.1.1

Released Tuesday 19th April 2016.

### Docs

- Switched to downloading template from Github
- Switched to Stuart's fork of Couscous

## v1.1.0

Released Sunday 17th April 2016.

### New

* Added [`GetPrintableType`](types/GetPrintableType.html)

## v1.0.0

Released Sunday 17th April 2016.

### New

* Added [`vnsprint()`](strings/vnsprintf.html)
