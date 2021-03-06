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

use ReflectionObject;
use ReflectionProperty;
use TypeError;

/**
 * get an object's non-static properties
 */
class FilterObjectProperties
{
    /**
     * get an object's non-static properties
     *
     * @param  object $target
     *         the object to examine
     * @param  int $filter
     *         the kind of properties to look for
     *         default is to look for public properties only
     * @return array
     *         a (possibly empty) read-only list of the object's
     *         non-static properties
     * @throws InvalidArgumentException
     *         if $target is not an object
     */
    public static function from($target, $filter = ReflectionProperty::IS_PUBLIC)
    {
        // robustness!!
        if (!is_object($target)) {
            throw new TypeError('$target is not an object, is a ' . get_printable_type($target));
        }

        // we must remove IS_STATIC from the filter mask
        // we are only looking for properties on the object
        if ($filter & ReflectionProperty::IS_STATIC) {
            $filter = $filter ^ ReflectionProperty::IS_STATIC;
        }

        // if we get here, then we want to do this
        $refObj = new ReflectionObject($target);
        $resultFilter = function(ReflectionProperty $refProp, &$finalResult) use($target, $filter) {
            if (!IsObjectProperty::check($refProp)) {
                return;
            }

            // now filter out any properties that don't match our initial
            // filter bitmask
            //
            // this can happen when $filer = ReflectionProperty::IS_PUBLIC
            if (!(int)($refProp->getModifiers() & $filter)) {
                return;
            }

            $finalResult[$refProp->getName()] = $refProp->getValue($target);
        };
        return FilterProperties::from($refObj, $filter, $resultFilter);
    }
}
