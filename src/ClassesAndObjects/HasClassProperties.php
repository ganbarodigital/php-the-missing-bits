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

namespace GanbaroDigital\MissingBits\ClassesAndObjects;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\Checks\ListCheckHelper;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionProperty;
use TypeError;

/**
 * does a class have static properties?
 */
class HasClassProperties implements Check, ListCheck
{
    // save us having to implement it ourselves
    use ListCheckHelper;

    /**
     * which types of property do we want to check for?
     * @var int
     */
    protected $propTypes;

    /**
     * create a customised HasClassProperties checker, ready to use
     *
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return HasClassProperties
     *         a customised Check, ready to use
     */
    public function __construct($propTypes = ReflectionProperty::IS_PUBLIC)
    {
        $this->propTypes = $propTypes;
    }

    /**
     * create a customised HasClassProperties checker, ready to use
     *
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return HasClassProperties
     *         a customised Check, ready to use
     */
    public static function using($propTypes = ReflectionProperty::IS_PUBLIC)
    {
        return new static($propTypes);
    }

    /**
     * does a class have static properties?
     *
     * @param  string $target
     *         the class to examine
     * @return boolean
     *         TRUE if the class has static properties
     *         FALSE otherwise
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public function inspect($target)
    {
        return static::check($target, $this->propTypes);
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
     *         TRUE if the class has static properties
     *         FALSE otherwise
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public static function check($target, $propTypes = ReflectionProperty::IS_PUBLIC)
    {
        // robustness!!
        if (!check_is_stringy($target)) {
            throw new TypeError('$target is not a string, is a ' . get_printable_type($target));
        }

        // make sure we have a valid class
        if (!class_exists($target) && !interface_exists($target)) {
            throw new InvalidArgumentException("class/interface '" . $target . "' not found");
        }

        // if we get here, then we want to do this
        $refObj = new ReflectionClass($target);
        $resultFilter = [IsClassProperty::class, 'check'];
        return HasFilteredProperties::check($refObj, $propTypes | ReflectionProperty::IS_STATIC, $resultFilter);
    }

    /**
     * does a list of classes have static properties?
     *
     * @param  mixed $list
     *         the list of classes to examine
     * @param  int $propTypes
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return boolean
     *         TRUE if the class has static properties
     *         FALSE otherwise
     * @throws InvalidArgumentException
     *         if $target is not a valid class name
     */
    public static function checkList($list, $propTypes = ReflectionProperty::IS_PUBLIC)
    {
        $check = new static($propTypes);
        return $check->inspectList($list);
    }
}
