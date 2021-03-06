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

use GanbaroDigital\MissingBits\Checks\CheckList;
use TypeError;

/**
 * do we have a list that contains only arrays?
 *
 * Everything in the list must be something that can be
 * used by any of PHP's array_xxx() functions
 */
class IsListOfArrays extends CheckList
{
    /**
     * creates a new CheckList, ready to use
     *
     * we do not support any customisations
     *
     * @return CheckList
     */
    public function __construct()
    {
        parent::__construct([
            new IsArray
        ]);
    }

    /**
     * creates a new CheckList, ready to use
     *
     * we do not support any customisations
     *
     * @return CheckList
     */
    public static function using()
    {
        return new static();
    }

    /**
     * do we have a list that contains only arrays?
     *
     * by array, we mean something that you can pass to any of PHP's
     * array_xxx() functions
     *
     * @param  mixed $list
     *         the list to be checked
     * @return bool
     *         TRUE if everythig in $list is an array
     *         FALSE otherwise
     * @throws TypeError
     *         if $list isn't an acceptable list
     */
    public static function check($list)
    {
        return static::using()->inspect($list);
    }
}
