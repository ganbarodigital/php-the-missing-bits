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

use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;

/**
 * work out who has called a piece of code, with optional support
 * for filtering out classes (e.g. classes used for enforcing robustness)
 */
class GetCaller
{
    /**
     * work out who has called a piece of code
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @return StackFrame
     */
    public function __invoke($backtrace, $filterList = [])
    {
        return self::from($backtrace, $filterList);
    }

    /**
     * work out who has called a piece of code
     *
     * @param  array $backtrace
     *         the debug_backtrace() return value
     * @param  array $filterList
     *         a list of namespaces and classes to skip over
     * @return StackFrame
     */
    public static function from($backtrace, $filterList = [])
    {
        // get the call stack frame that we want to return
        $frame = FilterBacktrace::from($backtrace, $filterList);

        // convert the stack frame into something that's easier to use
        $retval = new StackFrame($frame['class'], $frame['function'], $frame['type'], $frame['file'], $frame['line']);

        // all done
        return $retval;
    }
}
