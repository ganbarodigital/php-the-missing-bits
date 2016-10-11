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
 * @package   MissingBits/TypeChecks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\TypeChecks;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\Checks\ListCheckHelper;
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;
use InvalidArgumentException;

/**
 * is class or object compatible with a given type?
 */
class IsCompatibleWith implements Check, ListCheck
{
    // saves us having to implement inspectList() ourselves
    use ListCheckHelper;

    /**
     * the classname or object that we want to check for
     * @var string|object
     */
    private $expectedType;

    /**
     * our constructor
     *
     * @param  string|object $expectedType
     *         the classname or object that we want to check for
     */
    public function __construct($expectedType)
    {
        $this->expectedType = $expectedType;
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
    public static function check($fieldOrVar, $expectedType)
    {
        // robustness
        if (!IsStringy::check($expectedType) && !is_object($expectedType)) {
            throw new InvalidArgumentException("\$expectedType must be a classname or an object, is a " . GetPrintableType::of($expectedType));
        }

        if (is_object($fieldOrVar)) {
            return self::checkObject($fieldOrVar, $expectedType);
        }
        else if (is_string($fieldOrVar)) {
            return self::checkString($fieldOrVar, $expectedType);
        }
        else {
            return false;
        }
    }

    /**
     * is $fieldOrVar compatible with $expectedType?
     *
     * @param  object $fieldOrVar
     *         the object to check
     * @param  string|object $expectedType
     *         the class or object that $fieldOrVar must be compatible with
     * @return bool
     *         TRUE if $fieldOrVar is compatible
     *         FALSE otherwise
     */
    private static function checkObject($fieldOrVar, $expectedType)
    {
        // this is the easiest test case of all :)
        return $fieldOrVar instanceof $expectedType;
    }

    /**
     * is $fieldOrVar compatible with $expectedType?
     *
     * @param  string $fieldOrVar
     *         the class name to check
     * @param  string|object $expectedType
     *         the class or object that $fieldOrVar must be compatible with
     * @return bool
     *         TRUE if $fieldOrVar is compatible
     *         FALSE otherwise
     */
    private static function checkString($fieldOrVar, $expectedType)
    {
        $compatibleTypes = GetClassTypes::from($fieldOrVar);
        if (is_object($expectedType)) {
            $expectedType = get_class($expectedType);
        }

        // is our expectedType in the list of data types that $fieldOrVar can be?
        if (isset($compatibleTypes[$expectedType])) {
            return true;
        }

        // if we get here, we have run out of ideas
        return false;
    }

    /**
     * is $fieldOrVar compatible with $expectedType?
     *
     * @param  mixed $fieldOrVar
     *         the classname or object to check
     * @return bool
     *         TRUE if $fieldOrVar is compatible
     *         FALSE otherwise
     */
    public function inspect($fieldOrVar)
    {
        return static::check($fieldOrVar, $this->expectedType);
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
    public static function checkList($list, $expectedType)
    {
        $check = new static;
        return $check->inspectList($list, $expectedType);
    }
}
