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

use stdClass;

class GetObjectTypes
{
    /**
     * the extra items that *might* be part of an object's type list
     * @var array
     */
    private static $objectConditionalExtras = [
        "__toString" => "string",
        "__invoke"   => "callable",
    ];

    /**
     * get a full list of an objects's inheritence hierarchy and other types
     * that it can satisfy
     *
     * @param  object $item
     *         the item to examine
     * @return string[]
     *         the object's list of types
     */
    public function getObjectTypes($item)
    {
        return self::from($item);
    }

    /**
     * get a full list of an objects's inheritence hierarchy and other types
     * that it can satisfy
     *
     * @param  object $item
     *         the item to examine
     * @return string[]
     *         the object's list of types
     */
    public static function from($item)
    {
        // robustness!
        if (!is_object($item)) {
            return [];
        }

        $className = get_class($item);

        // our details are made up of this order:
        //
        // 1. details about the class
        // 2. that we are an object
        // 3. any magic methods that can be automatically taken advantage of
        // 4. the default fallback type
        $retval = array_merge(
            GetClassTypes::from($className),
            self::getObjectConditionalTypes($item)
        );

        return $retval;
    }

    /**
     * get the list of extra types that are valid for this specific object
     *
     * @param  object $object
     *         the object to examine
     * @return string[]
     *         a (possibly empty) list of types for this object
     */
    private static function getObjectConditionalTypes($object)
    {
        $retval = [];

        foreach (self::$objectConditionalExtras as $methodName => $type) {
            if (method_exists($object, $methodName)) {
                $retval[$type] = $type;
            }
        }

        return $retval;
    }
}
