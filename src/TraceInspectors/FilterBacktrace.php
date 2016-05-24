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
 * @package   MissingBits/Traces
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\TraceInspectors;
use GanbaroDigital\MissingBits\TypeInspectors\GetNamespace;

/**
 * find the first entry in a debug_backtrace() array that contains useful
 * information, with optional support for skipping over namespaces
 * (e.g. skip over namespaces used to enforce robustness)
 */
class FilterBacktrace
{
    /**
     * find first complete stack frame, optionally skipping over classes
     * and namespaces
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @param  int $index
     *         how far down the stack do we want to start looking from?
     * @return array
     */
    public function __invoke($backtrace, $filterList = [], $index = 1)
    {
        return self::from($backtrace, $filterList, $index);
    }

    /**
     * find first complete stack frame, optionally skipping over classes
     * and partial namespaces
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of partial namespaces and classes to skip over
     * @param  int $index
     *         how far down the stack do we want to start looking from?
     * @return array
     */
    public static function from($backtrace, $filterList = [], $index = 1)
    {
        // make sure we're not trying to look beyond the end of the stack trace
        $maxIndex = count($backtrace) - 1;
        $index = min($index, $maxIndex);

        // PHP's stack trace is a little esoteric. To find all the details about
        // a caller, we have to combine information from two stack frames.
        $prevFrame = $backtrace[max($index - 1,0)];

        // find the first backtrace entry that passes our filters
        for ($i = $index; $i <= $maxIndex; $i++) {
            // what are we looking at?
            $frame = $backtrace[$i];

            if (!isset($frame['class'])) {
                // called from global function
                return self::extractFrameDetails($frame, $prevFrame, $i);
            }

            // do we want to skip over this class name?
            if (self::isClassNameOkay($frame['class'], $filterList)) {
                return self::extractFrameDetails($frame, $prevFrame, $i);
            }

            $prevFrame = $frame;
        }

        // if we get here, then we have run out of places to look
        return self::extractFrameDetails($backtrace[1], $backtrace[0], 1);
    }

    /**
     * is the given classname NOT in our list to filter out?
     *
     * @param  string  $className
     *         the fully-qualified class name to check
     * @param  array $filterList
     *         the list of classes and namespaces to filter for
     * @return boolean
     *         TRUE if the classname is NOT in our list of partial namespaces
     *         FALSE otherwise
     */
    private static function isClassNameOkay($className, $filterList)
    {
        // the caller may be trying to filter out the class itself, or the
        // namespace that the class is inside.
        $searchList = [
            GetNamespace::from($className),
            $className
        ];

        if (empty(array_intersect($filterList, $searchList))) {
            return true;
        }

        // if we get here, then this class isn't one that we want to return
        // to the caller
        return false;
    }

    /**
     * extract only the stack frame fields we are interested in
     *
     * guarantees that the return value contains all four keys, even if they
     * are missing from the stack frame
     *
     * @param  array $frame1
     *         a stack frame from `debug_backtrace`
     * @param  int $stackIndex
     *         which part of the stack is $frame from?
     * @return array
     *         contains class, function, file, and line
     */
    private static function extractFrameDetails($frame1, $frame2, $stackIndex)
    {
        $retval = [
            'class' => null,
            'function' => null,
            'type' => null,
            'file' => null,
            'line' => null,
            'stackIndex' => $stackIndex,
        ];

        $frame1Details = [
            'class' => null,
            'function' => null,
            'type' => null,
        ];

        $frame2Details = [
            'file' => null,
            'line' => null,
        ];

        // we only want entries from the $frame array that we intend to return
        $parts1 = array_intersect_key($frame1, $frame1Details);
        $parts2 = array_intersect_key($frame2, $frame2Details);
        $retval = array_merge($retval, $parts1, $parts2);

        // all done
        return $retval;
    }
}
