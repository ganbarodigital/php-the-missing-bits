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
use ReflectionProperty;
use TypeError;

/**
 * is this property a class property?
 */
class IsClassProperty implements Check
{
    /**
     * is this property a class property?
     *
     * @param  ReflectionProperty $refProp
     *         the property to inspect
     * @return bool
     *         TRUE if $refProp is a class property
     *         FALSE otherwise
     */
    public static function check(ReflectionProperty $refProp)
    {
        if ($refProp->isStatic()) {
            return true;
        }

        return false;
    }

    /**
     * is this property a class property?
     *
     * NOTE: we cannot add a type-hint to $refProp below, as that will cause
     * a PHP Fatal Error
     *
     * @param  ReflectionProperty $refProp
     *         the property to inspect
     * @return bool
     *         TRUE if $refProp is a class property
     *         FALSE otherwise
     */
    public function inspect($refProp)
    {
        // robustness!
        if (! $refProp instanceof ReflectionProperty) {
            throw new TypeError('$refProp is not a ReflectionProperty, is a ' . get_printable_type($refProp));
        }
        return static::check($refProp);
    }

    /**
     * create a new IsClassProperty checker, ready to use
     *
     * we do not support any customisations
     *
     * @return IsClassProperty
     */
    public static function using()
    {
        return new static();
    }
}
