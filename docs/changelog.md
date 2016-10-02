# CHANGELOG

## develop branch

### New

* Added support for inspecting class and object properties
  - added `get_class_properties()`
  - added `get_object_properties()`
  - added `has_class_properties()`
  - added `has_object_properties()`
  - added `FilterClassProperties::from()`
  - added `FilterObjectProperties::from()`
  - added `FilterProperties` helper class
  - added `HasClassProperties::check()`
  - added `HasObjectProperties::check()`
  - added `HasFilteredProperties` helper class
  - added `IsClassProperty` helper class
  - added `IsObjectProperty` helper class
* Added support for a formal approach to writing IsXXX() classes
  - added `Check` interface
  - added `ListCheck` interface
  - added `ListCheckHelper` trait
* Added `Check` and `ListCheck` support to existing classes
  - added `IsStringy::check()`
  - `is_stringy()` now uses `IsStringy::check()`
  - `IsList` now implements `Check` and `ListCheck`
  - `IsListyObject` now implements `Check` and `ListCheck`
* Added a whole bunch of type checks, originally from our Defensive library:
  - added `IsArray::check()`
  - added `is_array_list()` convenience function
  - added `IsAssignable::check()`
* Added type-hinting / strict type declaration support for entities:
  - added empty `Entity` interface
* Added immutable support to entities
  - added `ReadOnlyForeverException` exception
  - added `setReadOnlyForever()` to `WriteProtectableEntity` interface
  - `WriteProtectableEntity::setReadWrite()` must now throw `ReadOnlyForeverException` if `setReadOnlyForever()` has been called
  - added `setReadOnlyForever()` to `WriteProtectTab` trait
  - `WriteProtectTab::setReadWrite()` now throws `ReadOnlyForeverException` if `WriteProtectTab::setReadOnlyForever()` has been called

### Refactor

Before refactoring, we checked Packagist to make sure that these changes would not break anything that depends upon The Missing Bits.

* Moved several classes from `TypeInspectors` to `TypeChecks`
  - moved `IsList`
  - moved `IsListyObject`
* Move away from `__invoke()` methods for objects
  - in practice, using objects via their `__invoke()` methods results in code that's hard to read and understand
  - we're switching to having the object's main method be the same as the class name
  - `FilterBacktrace::__invoke()` is now `FilterBacktrace::filterBacktrace()`
  - `GetArrayTypes::__invoke()` is now `GetArrayTypes::getArrayTypes()`
  - `GetCaller::__invoke()` is now `GetCaller::getCaller()`
  - `GetClassTraits::__invoke()` is now `GetClassTraits::getClassTraits()`
  - `GetClassTypes::__invoke()` is now `GetClassTypes::getClassTypes()`
  - `GetDuckTypes::__invoke()` is now `GetDuckTypes::getDuckTypes()`
  - `GetNamespace::__invoke()` is now `GetNamespace::getNamespace()`
  - `GetNumericType::__invoke()` is now `GetNumericType::getNumericType()`
  - `GetObjectTypes::__invoke()` is now `GetObjectTypes::getObjectTypes()`
  - `GetPrintableType::__invoke()` is now `GetPrintableType::getPrintableType()`
  - `GetStrictTypes::__invoke()` is now `GetStrictTypes::getStrictTypes()`
  - `GetStringDuckTypes::__invoke()` is now `GetStringDuckTypes::getStringDuckTypes()`

## v1.9.0

Released Sun 31st July 2016.

### New

* Added support for detecting lists
  - added `is_list()`
  - added `IsList::check()`
  - added `is_listy_object()`
  - added `IsListyObject::check()`

## v1.8.0

Released Sun 31st July 2016.

### New

* Added support for iterating over lists
  - added `traverse_array()`
  - added `TraverseArray::using()`
  - added `traverse_list()`
  - added `TraverseList::using()`
  - added `traverse_object()`
  - added `TraverseObject::using()`
* Added additional type inspections
  - added `is_stringy()`
* Additional string functions to help build PHP code snippets
  - added `quote_index()`
  - added `quote_property()`

## v1.7.0

Released Sun 19th June 2016.

### New

* Added some helpers to overcome `array_merge()` performance issues.
  - added `array_append_values()`
  - added `array_merge_keys()`

## v1.6.1

Released Sun 12th June 2016.

### Fixes

* Make sure `$flags` for `GetPrintableType` are always valid
  - if we get invalid flags, we use the default flags

## v1.6.0

Released Sun 12th June 2016.

### New

* Added some interfaces to map objects to PHP types / inspect objects as you'd inspect a PHP type
  - added `CanBeEmpty`
  - added `Listable`
  - added `Logical`

## v1.5.1

Released Wed 1st June 2016.

### Fixes

* `GetDuckTypes` now also returns `numeric` for PHP `double` and `integer` types

## v1.5.0

Released Tue 31st May 2016.

### New

* Extra duck type features
  - added `GetStringDuckTypes`
  - added `numeric` duck type; can be returned by
    - `GetDuckTypes`
    - `GetStringDuckTypes`

### Fixes

* Performance improvements to:
  - `GetDuckTypes`
* Scrutinizer-CI suggested fixes to:
  - `GetClassTraits`
  - `GetClassTypes`
  - `GetNamespace`
  - `GetPrintableType`
  - `GetStrictTypes`
  - `GetStringTypes`
  - `StripNamespace`
  - `get_caller`

## v1.4.0

Released Tue 24th May 2016.

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
