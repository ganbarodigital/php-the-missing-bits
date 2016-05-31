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
 * get a full list of types that a string might satisfy
 */
class GetStringTypes
{
    /**
     * get a full list of types that a string might satisfy
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public function __invoke($item)
    {
        return self::from($item);
    }

    /**
     * get a full list of types that a string might satisfy
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     *         the list of type(s) that this item can be
     */
    public static function from($item)
    {
        // special case - we might have a coercable object
        if (is_object($item)) {
            return self::fromObject($item);
        }

        // robustness!
        if (!is_string($item)) {
            return [];
        }

        // our return list
        $retval = [];

        // special case - strings can be callables too
        if (is_callable($item)) {
            $retval['callable'] = 'callable';
        }

        // special case - strings can be numbers too
        $retval = array_merge($retval, self::detectNumbers($item));

        // all done
        $retval['string'] = 'string';
        return $retval;
    }

    /**
     * will this string co-erce to any numeric types?
     *
     * @param  string $item
     *         the item to examine
     * @return string[]
     */
    private static function detectNumbers($item)
    {
        // what do we think this might be?
        $retval = GetNumericType::from($item);

        // special case - return an empty list if the string
        // isn't numeric at all
        if ($retval === null) {
            return [];
        }

        // if we get here, then $item will coerce to a PHP numeric type :)
        return [ $retval => $retval ];
    }

    private static function fromObject($item)
    {
        // does this object support being converted to a string?
        if (method_exists($item, '__toString')) {
            return [ 'string' => 'string' ];
        }

        // no, it does not
        return [];
    }
}
