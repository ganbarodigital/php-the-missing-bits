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
 * get a full list of a class's inheritence hierarchy
 */
class GetClassTypes
{
    /**
     * get a full list of a class's inheritence hierarchy
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the class's inheritence hierarchy
     */
    public function getClassTypes($item)
    {
        return self::from($item);
    }

    /**
     * get a full list of a class's inheritence hierarchy
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the class's inheritence hierarchy
     */
    public static function from($item)
    {
        // special case - are we looking at an object?
        if (is_object($item)) {
            $item = get_class($item);
        }

        // robustness!
        if (!is_string($item)) {
            return [];
        }

        if (!class_exists($item) && !interface_exists($item)) {
            return [];
        }

        // our return value
        $retval = array_merge(
            [$item => $item],
            self::getClassHierarchy($item),
            self::getInterfaceHierarchy($item)
        );

        return $retval;
    }

    /**
     * get a list of parent classes
     *
     * @param  string $className
     *         the class or interface to examine
     * @return string[]
     */
    private static function getClassHierarchy($className)
    {
        // our return value
        $retval = [];

        foreach (class_parents($className) as $parentName) {
            $retval[$parentName] = $parentName;
        }

        // all done
        return $retval;
    }

    /**
     * get a list of implemented interfaces
     *
     * @param  string $className
     *         the class or interface to examine
     * @return string[]
     */
    private static function getInterfaceHierarchy($className)
    {
        // our return value
        $retval = [];

        foreach (class_implements($className) as $interfaceName) {
            $retval[$interfaceName] = $interfaceName;
        }

        // all done
        return $retval;
    }
}
