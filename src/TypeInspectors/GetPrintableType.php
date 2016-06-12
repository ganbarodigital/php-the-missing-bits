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
 * @package   MissingBits/Types
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\TypeInspectors;

use Closure;

/**
 * GetPrintableType will tell you the PHP data type of any given input data.
 */
class GetPrintableType
{
    const FLAG_NONE = 0;
    const FLAG_CLASSNAME = 1;
    const FLAG_CALLABLE_DETAILS = 2;
    const FLAG_SCALAR_VALUE = 4;
    const FLAG_MAX_VALUE = 7;

    const FLAG_DEFAULTS = 7;

    /**
     * what PHP type is $data?
     *
     * @param  mixed $data
     *         the data to examine
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $data
     */
    public function __invoke($data, $flags = self::FLAG_DEFAULTS)
    {
        return self::of($data, $flags);
    }

    /**
     * what PHP type is $data?
     *
     * @param  mixed $data
     *         the data to examine
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $data
     */
    public static function of($data, $flags = self::FLAG_DEFAULTS)
    {
        // make sure we have a usable set of flags
        if (!is_int($flags)) {
            $flags = self::FLAG_DEFAULTS;
        }
        if ($flags < 0 || $flags > self::FLAG_MAX_VALUE) {
            $flags = self::FLAG_DEFAULTS;
        }

        if (is_object($data)) {
            return self::returnObjectType($data, $flags);
        }

        if (is_callable($data)) {
            return self::returnCallableType($data, $flags);
        }

        if (is_scalar($data)) {
            return self::returnScalarType($data, $flags);
        }

        return gettype($data);
    }

    /**
     * extract the details about a PHP callable array
     *
     * @param  array|string $data
     *         the callable() to examine
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $data
     */
    private static function returnCallableType($data, $flags)
    {
        // user doesn't want the details
        if (!($flags & self::FLAG_CALLABLE_DETAILS)) {
            return "callable";
        }

        // $data may contain the name of a function
        if (!is_array($data)) {
            return "callable<" . $data . ">";
        }

        // $data may contain a <classname, method> pair
        if (is_string($data[0])) {
            return "callable<" . $data[0] . "::" . $data[1] . ">";
        }

        // $data contains an <object, method> pair
        return "callable<" . get_class($data[0]). "::" . $data[1] . ">";
    }

    /**
     * turn a PHP object into the underlying PHP data type
     *
     * @param  object $data
     *         the data to inspect
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $data
     */
    private static function returnObjectType($data, $flags)
    {
        // special case - PHP Closure objects
        if ($data instanceof Closure) {
            return 'callable';
        }

        // does the caller want to know what kind of object?
        if ($flags & self::FLAG_CLASSNAME) {
            return 'object<' . get_class($data) . '>';
        }

        // if we get here, then a plain 'object' will suffice
        return "object";
    }

    /**
     * extract the details about a PHP scalar value
     *
     * @param  boolean|double|int|string $data
     *         the data to examine
     * @param  int $flags
     *         options to change what we put in the return value
     * @return string
     *         the data type of $data
     */
    private static function returnScalarType($data, $flags)
    {
        // user doesn't want the details
        if (!($flags & self::FLAG_SCALAR_VALUE)) {
            return gettype($data);
        }

        // special case - boolean values
        if (is_bool($data)) {
            if ($data) {
                return "boolean<true>";
            }
            return "boolean<false>";
        }

        // general case
        return gettype($data) . "<{$data}>";
    }
}
