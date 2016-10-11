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
 * @package   MissingBits/ListTraversals
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\ListTraversals;

use GanbaroDigital\MissingBits\TypeChecks\IsList;
use InvalidArgumentException;

/**
 * traverse a list and traverse all of its contents
 */
class RecursiveTraverse
{
    /**
     * traverse a list held in an object
     *
     * @param  object $list
     *         the list to walk
     * @param  string $listName
     *         what is the name of $list in the calling code?
     * @param  callable $callback
     *         what are we calling
     * @return void
     */
    public static function using($list, $listName, callable $callback)
    {
        // robustness!
        if (!IsList::check($list)) {
            throw new InvalidArgumentException($listName . ' cannot be traversed as a list');
        }

        self::iterateOver($list, '', $callback);
    }

    /**
     * apply a callback to every item in a list, including their children
     * too
     *
     * @param  mixed   $item
     *         what we are iterating over
     * @param  string   $path
     *         where we are in the data structure so far
     * @param  callable $callback
     *         the callback to apply
     * @return void
     */
    private static function iterateOver($item, $path, callable $callback)
    {
        // do we need to do anything with this?
        if (!is_array($item) && !is_object($item)) {
            // no, we do not
            return;
        }

        // here we go ...
        foreach ($item as $key => $data) {
            $callback($data, $key, $path);
            $newPath = $path . $key . '.';
            self::iterateOver($data, $newPath, $callable);
        }
    }
}
