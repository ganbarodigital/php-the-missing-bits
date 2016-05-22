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

/**
 * return a practical list of data types for any value or variable
 */
class GetDuckTypes
{
    /**
     * the extra items to append to any array's type list
     *
     * @var array
     */
    private static $arrayExtras = [
        'Traversable' => 'Traversable'
    ];

    /**
     * the extra items that *might* be part of an object's type list
     * @var array
     */
    private static $objectConditionalExtras = [
        "__toString" => "string",
        "__invoke"   => "callable",
    ];

    /**
     * return a practical list of data types for any value or variable
     *
     * @param  mixed $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public function __invoke($item)
    {
        return self::from($item);
    }

    /**
     * return a practical list of data types for any value or variable
     *
     * @param  mixed $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public static function from($item)
    {
        $type = gettype($item);
        $methodName = 'from' . ucfirst($type);
        if (method_exists(self::class, $methodName)) {
            return call_user_func_array([self::class, $methodName], [$item]);
        }

        // if we get here, then we just return the PHP scalar type
        return [ $type => $type ];
    }

    /**
     * get the list of possible types that could match an array
     *
     * @param  array $item
     *         the item to examine
     * @return string[]
     *         a list of matching types
     */
    private static function fromArray($item)
    {
        // our return type
        $retval = array_merge(
            array_slice(GetArrayTypes::from($item), 0, -1),
            self::$arrayExtras,
            [ 'array' => 'array' ]
        );

        // all done
        return $retval;
    }

    /**
     * get the list of possible types that could match an object
     *
     * @param  object $item
     *         the item to examine
     * @return string[]
     *         a list of matching objects
     */
    private static function fromObject($item)
    {
        $className = get_class($item);

        $retval = array_merge(
            GetObjectTypes::from($item),
            self::getObjectSpecialTypes($item),
            [ 'object' => 'object' ]
        );

        return $retval;
    }

    /**
     * hard-coded rules for dealing with PHP's built-in classes
     *
     * @param  object $object
     *         object to examine
     * @return array
     */
    private static function getObjectSpecialTypes($object)
    {
        $retval = [];

        if ($object instanceof stdClass) {
            $retval['Traversable'] = 'Traversable';
        }

        return $retval;
    }

    /**
     * return any data type's type name
     *
     * @param  mixed $item
     *         the item to examine
     * @return array
     *         the basic type of the examined item
     */
    private static function fromString($item)
    {
        // our return value
        $retval = [];

        // special case - is this a class name?
        if (class_exists($item)) {
            $retval = array_merge($retval, GetClassTypes::from($item), ['class' => 'class']);
        }
        else if (interface_exists($item)) {
            $retval = array_merge($retval, GetClassTypes::from($item), ['interface' => 'interface']);
        }

        // pull in the list of strict string types too
        $retval = array_merge($retval, GetStringTypes::from($item));

        // all done
        return $retval;
    }
}
