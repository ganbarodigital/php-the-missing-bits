<?php

/**
 * Copyright (c) 2016-present Ganbaro Digital Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Libraries
 * @package   MissingBits/Types
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

use GanbaroDigital\MissingBits\TypeChecks\IsArray;
use GanbaroDigital\MissingBits\TypeChecks\IsAssignable;
use GanbaroDigital\MissingBits\TypeChecks\IsBoolean;
use GanbaroDigital\MissingBits\TypeChecks\IsCallable;
use GanbaroDigital\MissingBits\TypeChecks\IsList;
use GanbaroDigital\MissingBits\TypeChecks\IsListyObject;
use GanbaroDigital\MissingBits\TypeChecks\IsCompatibleWith;
use GanbaroDigital\MissingBits\TypeChecks\IsDefinedClass;
use GanbaroDigital\MissingBits\TypeChecks\IsDefinedInterface;
use GanbaroDigital\MissingBits\TypeChecks\IsDefinedObjectType;
use GanbaroDigital\MissingBits\TypeChecks\IsDefinedTrait;
use GanbaroDigital\MissingBits\TypeChecks\IsDouble;
use GanbaroDigital\MissingBits\TypeChecks\IsEmpty;
use GanbaroDigital\MissingBits\TypeChecks\IsIndexable;
use GanbaroDigital\MissingBits\TypeChecks\IsInteger;
use GanbaroDigital\MissingBits\TypeChecks\IsLogical;
use GanbaroDigital\MissingBits\TypeChecks\IsNull;
use GanbaroDigital\MissingBits\TypeChecks\IsNumeric;
use GanbaroDigital\MissingBits\TypeChecks\IsObject;
use GanbaroDigital\MissingBits\TypeChecks\IsObjectOfType;
use GanbaroDigital\MissingBits\TypeChecks\IsPcreRegex;
use GanbaroDigital\MissingBits\TypeChecks\IsResource;
use GanbaroDigital\MissingBits\TypeChecks\IsStringy;
use GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTraits;
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;
use GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetStringDuckTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes;
use GanbaroDigital\MissingBits\TypeInspectors\StripNamespace;

/**
 * do we have something that is an array?
 *
 * by array, we mean something that you can pass to any of PHP's
 * array_xxx() functions
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item is an array
 *         FALSE otherwise
 */
function check_is_array($fieldOrVar)
{
    return IsArray::check($fieldOrVar);
}

/**
 * is every entry in $list an array?
 *
 * by array, we mean something that you can pass to any of PHP's
 * array_xxx() functions
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is an array
 *         FALSE otherwise
 */
function check_is_array_list($list)
{
    return IsArray::checkList($list);
}

/**
 * do we have something that can be used with PHP's object notation
 * for assigning the value of variables?
 *
 * @param  mixed $fieldOrVar
 *         the item to examine
 * @return bool
 *         true if the item is compatible
 *         false otherwise
 */
function check_is_assignable($fieldOrVar)
{
    return IsAssignable::check($fieldOrVar);
}

/**
 * can every item in $list be used with PHP's object notation for
 * assigning the valule of variables?
 *
 * @param  mixed $list
 *         the list to examine
 * @return bool
 *         true if every item in $list is compatible
 *         false otherwise
 */
function check_is_assignable_list($list)
{
    return IsAssignable::checkList($list);
}

/**
 * do we have something that is a boolean?
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item is a boolean
 *         FALSE otherwise
 */
function check_is_boolean($fieldOrVar)
{
    return IsBoolean::check($fieldOrVar);
}

/**
 * do we have a list of booleans?
 *
 * @param  mixed $list
 *         the list to be checked
 * @return bool
 *         TRUE if every item in the list is a boolean
 *         FALSE otherwise
 */
function check_is_boolean_list($list)
{
    return IsBoolean::checkList($list);
}

/**
 * do we have something that can be used as a PHP callable?
 *
 * @param  mixed $fieldOrVar
 *         the value to check
 * @return bool
 *         TRUE if $fieldOrVar is a callable
 *         FALSE otherwise
 */
function check_is_callable($fieldOrVar)
{
    return IsCallable::check($fieldOrVar);
}

/**
 * is every entry in $list a callable?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a callable
 *         FALSE otherwise
 */
function check_is_callable_list($list)
{
    return IsCallable::checkList($list);
}

/**
 * is $fieldOrVar compatible with $expectedType?
 *
 * @param  mixed $fieldOrVar
 *         the classname or object to check
 * @param  string|object $expectedType
 *         the classname or object that we want to check for
 * @return bool
 *         TRUE if $fieldOrVar is compatible
 *         FALSE otherwise
 */
function check_is_compatible_with($fieldOrVar, $expectedType)
{
    return IsCompatibleWith::check($fieldOrVar, $expectedType);
}

/**
 * is every entry in $list compatible with $expectedType?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @param  string $expectedType
 *         the class or interface that we want to check against
 * @return bool
 *         TRUE if every item in $list is a classname or object of
 *         a given type
 *         FALSE otherwise
 */
function check_is_compatible_with_list($list, $expectedType)
{
    return IsCompatibleWith::checkList($list, $expectedType);
}

/**
 * do we have the name of a class that has been defined?
 *
 * @param mixed $fieldOrVar
 *        the name to check
 * @return bool
 *         TRUE if $fieldOrVar is a class that has been defined
 *         FALSE otherwise
 */
function check_is_defined_class($fieldOrVar)
{
    return IsDefinedClass::check($fieldOrVar);
}

/**
 * is every entry in $list a defined class?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a defined class
 *         FALSE otherwise
 */
function check_is_defined_class_list($list)
{
    return IsDefinedClass::checkList($list);
}

/**
 * do we have the name of an interface that has been defined?
 *
 * @param mixed $fieldOrVar
 *        the name to check
 * @return bool
 *         TRUE if $fieldOrVar is an interface that has been defined
 *         FALSE otherwise
 */
function check_is_defined_interface($fieldOrVar)
{
    return IsDefinedInterface::check($fieldOrVar);
}

/**
 * is every entry in $list a defined interface?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a defined interface
 *         FALSE otherwise
 */
function is_defined_interface_list($list)
{
    return IsDefinedInterface::checkList($list);
}

/**
 * is $fieldOrVar a valid type for an object?
 *
 * @param mixed $fieldOrVar
 *        the name to check
 * @return bool
 *         TRUE if $fieldOrVar is a class or interface name
 *         FALSE otherwise
 */
function check_is_defined_object_type($fieldOrVar)
{
    return IsDefinedObjectType::check($fieldOrVar);
}

/**
 * is every entry in $list a valid type for an object?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a a valid type for an object
 *         FALSE otherwise
 */
function check_is_defined_object_type_list($list)
{
    return IsDefinedObjectType::checkList($list);
}

/**
 * do we have the name of a trait that has been defined?
 *
 * @param mixed $fieldOrVar
 *        the name to check
 * @return bool
 *         TRUE if $fieldOrVar is a trait that has been defined
 *         FALSE otherwise
 */
function check_is_defined_trait($fieldOrVar)
{
    return IsDefinedTrait::check($fieldOrVar);
}

/**
 * is every entry in $list a defined class?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a defined class
 *         FALSE otherwise
 */
function check_is_defined_trait_list($list)
{
    return IsDefinedTrait::checkList($list);
}

/**
 * do we have something that is a double?
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item is a double, or can be used as a double
 *         FALSE otherwise
 */
function check_is_double($fieldOrVar)
{
    return IsDouble::check($fieldOrVar);
}

/**
 * is every entry in $list a double?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a defined class
 *         FALSE otherwise
 */
function check_is_double_list($list)
{
    return IsDouble::checkList($list);
}

/**
 * check if an item is empty
 *
 * empty means one of:
 * - item itself is empty
 * - item is a data container, and only contains empty data items
 *
 * BE AWARE that this check WILL descend down into the contents of $fieldOrVar
 * until it finds the first piece of non-empty data. This has the potential
 * to be computationally expensive.
 *
 * @param  mixed $fieldOrVar
 *         the item to check
 * @return bool
 *         TRUE if the item is empty
 *         FALSE otherwise
 */
function check_is_empty($fieldOrVar)
{
    return IsEmpty::check($fieldOrVar);
}

/**
 * is every entry in $list empty?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is empty
 *         FALSE otherwise
 */
function check_is_empty_list($list)
{
    return IsEmpty::checkList($list);
}

/**
 * is $fieldOrVar something that can be used by PHP code that uses array
 * index notation?
 *
 * @param  mixed $fieldOrVar
 *         the item to examine
 * @return bool
 *         true if the item is compatible
 *         false otherwise
 */
function check_is_indexable($fieldOrVar)
{
    return IsIndexable::check($fieldOrVar);
}

/**
 * is every entry in $list indexable?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is indexable
 *         FALSE otherwise
 */
function check_is_indexable_list($list)
{
    return IsIndexable::checkList($list);
}

/**
 * do we have something that is an integer?
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item is an integer, or can be used as an integer
 *         FALSE otherwise
 */
function check_is_integer($fieldOrVar)
{
    return IsInteger::check($fieldOrVar);
}

/**
 * is every entry in $list an integer?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is an integer
 *         FALSE otherwise
 */
function check_is_integer_list($list)
{
    return IsInteger::checkList($list);
}

/**
 * do we have something that is an integer?
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item is an integer, or can be used as an integer
 *         FALSE otherwise
 */
function check_is_integer($fieldOrVar)
{
    return IsInteger::check($fieldOrVar);
}

/**
 * is every entry in $list an integer?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is an integer
 *         FALSE otherwise
 */
function check_is_integer_list($list)
{
    return IsInteger::checkList($list);
}

/**
 * can $list be safely (and sensibly) used in a foreach() loop?
 *
 * @param  mixed $list
 *         the value to inspect
 * @return bool
 *         TRUE if $list can be used in a foreach() loop
 *         FALSE otherwise
 */
function check_is_list($list)
{
    return IsList::check($list);
}

/**
 * can $list be safely (and sensibly) used in a foreach() loop?
 *
 * @param  object $list
 *         the value to inspect
 * @return bool
 *         TRUE if $list can be used in a foreach() loop
 *         FALSE otherwise
 */
function check_is_listy_object($list)
{
    return IsListyObject::check($list);
}

/**
 * do we have something that can be used as a boolean value?
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item can be used as a boolean
 *         FALSE otherwise
 */
function check_is_logical($fieldOrVar)
{
    return IsLogical::check($fieldOrVar);
}

/**
 * is every entry in $list something that can be used as a boolean value?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list can be used as a boolean
 *         FALSE otherwise
 */
function check_is_logical_list($list)
{
    return IsLogical::checkList($list);
}

/**
 * do we have something that is null?
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item is null
 *         FALSE otherwise
 */
function check_is_null($fieldOrVar)
{
    return IsNull::check($fieldOrVar);
}

/**
 * is every entry in $list a NULL value?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list is a NULL value
 *         FALSE otherwise
 */
function check_is_null_list($list)
{
    return IsNull::checkList($list);
}

/**
 * do we have something that can be used as a number?
 *
 * NOTE that we don't guarantee an int, a float, or even a base-10
 * number in this check, even though that might be what you're hoping
 * for
 *
 * @param  mixed $fieldOrVar
 *         the item to be checked
 * @return bool
 *         TRUE if the item can be used as a number
 *         FALSE otherwise
 */
function check_is_numeric($fieldOrVar)
{
    return IsNumeric::check($fieldOrVar);
}

/**
 * is every entry in $list a number of some kind?
 *
 * @param  mixed $list
 *         the list of items to be checked
 * @return bool
 *         TRUE if every item in $list can be used as a number
 *         FALSE otherwise
 */
function check_is_numeric_list($list)
{
    return IsNumeric::checkList($list);
}

/**
 * is $item something that PHP will accept as a string?
 *
 * @param  mixed $item
 *         the variable to examine
 * @return bool
 *         TRUE if PHP will happily use $item as a string
 *         FALSE otherwise
 */
function check_is_stringy($item)
{
    return IsStringy::check($item);
}

/**
 * get a full list of strict types than an array can satisfy
 *
 * @param  array $item
 *         the item to examine
 * @return string[]
 *         the array's list of types
 */
function get_array_types($item)
{
    return GetArrayTypes::from($item);
}

/**
 * get a full list of the traits used by a class or its parents
 *
 * @param  string $item
 *         the item to examine
 * @return string[]
 *         the class's traits list
 */
function get_class_traits($item)
{
    return GetClassTraits::from($item);
}

/**
 * get a full list of a class's inheritence hierarchy
 *
 * @param  string $item
 *         the item to examine
 * @return string[]
 *         the class's inheritence hierarchy
 */
function get_class_types($item)
{
    return GetClassTypes::from($item);
}

/**
 * return a practical list of data types for any value or variable
 *
 * @param  mixed $item
 *         the item to examine
 * @return string[]
 *         the list of type(s) that this item can be
 */
function get_duck_types($item)
{
    return \GanbaroDigital\MissingBits\TypeInspectors\GetDuckTypes::from($item);
}

/**
 * what namespace does a class live within?
 *
 * @param  string|object $item
 *         the item to examine
 * @return string
 *         the class's namespace
 * @throws InvalidArgumentException
 *         - if we have not been given a string or object
 *         - if the string does not contain the name of a defined
 *           class / interface / trait
 */
function get_namespace($item)
{
    return GetNamespace::from($item);
}

/**
 * do we have a numeric type? if so, what is it?
 *
 * @param  mixed $item
 *         the item to examine
 * @return string|null
 *         the numeric type, or null if it is not numeric
 */
function get_numeric_type($item)
{
    return GetNumericType::from($item);
}

/**
 * get the list of extra types that are valid for this specific object
 *
 * @param  object $item
 *         the object to examine
 * @return string[]
 *         a (possibly empty) list of types for this object
 */
function get_object_types($item)
{
    return GetObjectTypes::from($item);
}

/**
 * what PHP type is $item?
 *
 * @param  mixed $item
 *         the data to examine
 * @param  int $flags
 *         options to change what we put in the return value
 * @return string
 *         the data type of $item
 */
function get_printable_type($item, $flags = GetPrintableType::FLAG_DEFAULTS)
{
    return GetPrintableType::of($item, $flags);
}

/**
 * return any data type's type name list
 *
 * @param  mixed $item
 *         the item to examine
 * @return array
 *         the list of type(s) that this item can be
 */
function get_strict_types($item)
{
    return GetStrictTypes::from($item);
}

/**
 * get a full list of types that a string might satisfy
 *
 * @param  string $item
 *         the item to examine
 * @return string[]
 *         the list of type(s) that this item can be
 */
function get_string_duck_types($item)
{
    return GetStringDuckTypes::from($item);
}

/**
 * get a full list of types that a string might satisfy
 *
 * @param  string $item
 *         the item to examine
 * @return string[]
 *         the list of type(s) that this item can be
 */
function get_string_types($item)
{
    return GetStringTypes::from($item);
}

/**
 * get the name of a class, minus its namespace
 *
 * @param  string|object $item
 *         the item to examine
 * @return string
 *         the class's non-qualified classname
 * @throws InvalidArgumentException
 *         - if we have not been given a string or object
 *         - if the string does not contain the name of a defined
 *           class / interface / trait
 */
function strip_namespace($item)
{
    return StripNamespace::from($item);
}
