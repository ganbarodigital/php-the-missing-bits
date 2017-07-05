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

use ArrayAccess;
use GanbaroDigital\MissingBits\Checks\Check;

/**
 * do we have something that we can use array index notation on?
 */
class IsIndexable implements Check
{
    /**
     * fluent-interface entry point
     *
     * we do not support any customisations
     *
     * @return IsIndexable
     */
    public static function using()
    {
        return new static();
    }

    /**
     * is $fieldOrVar something that can be used by PHP code that uses array
     * index notation?
     *
     * @param  mixed $fieldOrVar
     *         the item to examine
     * @return bool
     *         true if the item is compatible
     *         false otherwise
     */
    public static function check($fieldOrVar)
    {
        if (is_array($fieldOrVar) || $fieldOrVar instanceof ArrayAccess) {
            return true;
        }

        return false;
    }

    /**
     * is $fieldOrVar something that can be used by PHP code that uses array
     * index notation?
     *
     * @param  mixed $fieldOrVar
     *         the item to examine
     * @return bool
     *         true if the item is compatible
     *         false otherwise
     */
    public function inspect($fieldOrVar)
    {
        return static::check($fieldOrVar);
    }
}
