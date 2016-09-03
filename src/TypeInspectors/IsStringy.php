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
 * @package   MissingBits/TypeInspectors
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\TypeInspectors;

use GanbaroDigital\Defensive\V1\Checks\ListableCheck;
use GanbaroDigital\Defensive\V1\Interfaces\Check;
use GanbaroDigital\Defensive\V1\Interfaces\ListCheck;

/**
 * is $item something that PHP will accept as a string?
 */
class IsStringy implements Check, ListCheck
{
    // saves us having to implement inspectList() ourselves
    use ListableCheck;

    /**
     * is $item something that PHP will accept as a string?
     *
     * @param  mixed $item
     *         the variable to examine
     * @return boolean
     *         TRUE if PHP will happily use $item as a string
     *         FALSE otherwise
     */
    public static function check($item)
    {
        // PHP will auto-convert these to strings without generating
        // any errors
        if (is_string($item) || is_int($item) || is_double($item)) {
            return true;
        }

        // depends if the object has the __toString() method or not
        if (is_object($item)) {
            return method_exists($item, '__toString');
        }

        // there's no point turning these into strings
        //
        // NULL
        // array
        // boolean
        // callable
        // resource
        return false;
    }

    /**
     * is $item something that PHP will accept as a string?
     *
     * @param  mixed $item
     *         the variable to examine
     * @return boolean
     *         TRUE if PHP will happily use $item as a string
     *         FALSE otherwise
     */
    public function inspect($list)
    {
        return static::check($list);
    }

    /**
     * are all items in $list something that PHP will accept as a string?
     *
     * @param  mixed $list
     *         the variable to examine
     * @return boolean
     *         TRUE if PHP will happily use all the items in $list as a string
     *         FALSE otherwise
     */
    public static function checkList($list)
    {
        $check = new static();
        return $check->inspectList($list);
    }
}
