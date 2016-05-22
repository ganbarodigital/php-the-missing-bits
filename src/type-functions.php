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

use GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;
use GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;
use GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes;

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
 * @param  object $object
 *         the object to examine
 * @return string[]
 *         a (possibly empty) list of types for this object
 */
function get_object_types($item)
{
    return GetObjectTypes::from($item);
}

/**
 * what PHP type is $data?
 *
 * @param  mixed $data
 *         the data to examine
 * @param  int $flags
 *         options to change what we put in the return value
 * @return string
 *         the data type of $data
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
function get_string_types($item)
{
    return GetStringTypes::from($item);
}
