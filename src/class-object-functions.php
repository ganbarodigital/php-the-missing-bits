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
 * @package   MissingBits/ClassesAndObjects
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;
use GanbaroDigital\MissingBits\ClassesAndObjects\FilterObjectProperties;
use GanbaroDigital\MissingBits\ClassesAndObjects\HasClassProperties;
use GanbaroDigital\MissingBits\ClassesAndObjects\HasObjectProperties;

/**
 * get a class's static properties
 *
 * @param  string $target
 *         the class to examine
 * @param  int $propTypes
 *         the kind of properties to look for
 *         default is to look for public properties only
 * @return array
 *         a (possibly empty) read-only list of the class's static properties
 * @throws InvalidArgumentException
 *         if $target is not a valid class name
 */
function get_class_properties($target, $propTypes = ReflectionProperty::IS_PUBLIC)
{
    // our helper class has all the answers
    return FilterClassProperties::from($target, $propTypes);
}

/**
 * does a class have static properties?
 *
 * @param  string $target
 *         the class to examine
 * @param  int $propTypes
 *         the kind of properties to look for
 *         default is to look for public properties only
 * @return boolean
 *         TRUE if $target is a class with static properties
 *         FALSE otherwise
 */
function has_class_properties($target, $propTypes = ReflectionProperty::IS_PUBLIC)
{
    return HasClassProperties::check($target, $propTypes);
}

/**
 * get an object's properties
 *
 * @param  object $target
 *         the object to examine
 * @param  int $propTypes
 *         the kind of properties to look for
 *         default is to look for public properties only
 * @return array
 *         a (possibly empty) read-only list of the class's static properties
 * @throws InvalidArgumentException
 *         if $target is not an object
 */
function get_object_properties($target, $propTypes = ReflectionProperty::IS_PUBLIC)
{
    // our helper class has all the answers
    return FilterObjectProperties::from($target, $propTypes);
}

/**
 * does an object have properties?
 *
 * @param  object  $target
 *         the object to examine
 * @param  int $propTypes
 *         the kind of properties to look for
 *         default is to look for public properties only
 * @return boolean
 *         TRUE if $target is an object with properties
 *         FALSE otherwise
 */
function has_object_properties($target, $propTypes = ReflectionProperty::IS_PUBLIC)
{
    return HasObjectProperties::check($target, $propTypes);
}
