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

/**
 * do we have a valid type name for an object?
 */
class IsDefinedObjectType implements Check, ListCheck
{
    // saves us having to implement inspectList() ourselves
    use ListCheckHelper;

    /**
     * is $fieldOrVar a valid type for an object?
     *
     * @param mixed $fieldOrVar
     *        the name to check
     * @return bool
     *         TRUE if $fieldOrVar is a class or interface name
     *         FALSE otherwise
     */
    public static function check($fieldOrVar)
    {
        // this prevents PHP runtime errors
        if (!IsStringy::check($fieldOrVar)) {
            return false;
        }

        // general cases
        if (class_exists($fieldOrVar) || interface_exists($fieldOrVar)) {
            return true;
        }

        // if we get here, we have run out of ideas
        return false;
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
    public function inspect($fieldOrVar)
    {
        return static::check($fieldOrVar);
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
    public static function checkList($list)
    {
        $check = new static;
        return $check->inspectList($list);
    }
}
