<?php

/**
 * Copyright (c) 2015-present Ganbaro Digital Ltd
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
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\TypeInspectors;

/**
 * get a full list of the traits used by a class or its parents
 */
class GetClassTraits
{
    /**
     * get a full list of the traits used by a class or its parents
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the class's traits list
     */
    public function __invoke($item)
    {
        return self::from($item);
    }

    /**
     * get a full list of the traits used by a class or its parents
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the class's traits list
     */
    public static function from($item)
    {
        // let's start with a class hierarchy
        $classes = GetClassTypes::from($item);
        if (count($classes) === 0) {
            return [];
        }

        // let's get the list of traits for this hierarchy
        $retval = [];
        foreach ($classes as $className) {
            $retval = array_merge($retval, static::getTraits($className));
        }

        // all done
        return $retval;
    }

    /**
     * get a list of traits from a given class, and from the traits in
     * that class
     *
     * @param  string $className
     *         the class or trait to examine
     * @return string[]
     *         a list of the traits used by $className
     */
    private static function getTraits($className)
    {
        $retval = [];
        $traits = class_uses($className);

        foreach ($traits as $trait) {
            $retval[$trait] = $trait;
            $retval = array_merge($retval, static::getTraits($trait));
        }

        return $retval;
    }
}
