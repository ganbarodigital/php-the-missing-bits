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

/**
 * StackFrame holds details about a single entry in a PHP stack trace
 */
class StackFrame
{
    /**
     * which class has been executed?
     *
     * @var string|null
     */
    private $class;

    /**
     * which function or method has been executed?
     *
     * @var string|null
     */
    private $function;

    /**
     * how was the function or method called?
     *
     * @var string|null
     */
    private $callType;

    /**
     * which file was the code in?
     *
     * @var string|null
     */
    private $file;

    /**
     * which line in $file was the code on?
     *
     * @var int|null
     */
    private $line;

    /**
     * what were the contents of the call stack at the time?
     *
     * @var array
     */
    private $stack;

    /**
     * constructor
     *
     * @param string|null $class
     *        which class has been executed?
     * @param string|null $function
     *        which function or method has been executed?
     * @param string|null $callType
     *        how was $function called?
     * @param string|null $file
     *        which file was the calling code in?
     * @param int|null $line
     *        which line in $file was the calling code on?
     * @param array $stack
     *        what was the call stack at the time?
     */
    public function __construct($class, $function, $callType, $file, $line, $stack = [])
    {
        $this->class = $class;
        $this->function = $function;
        $this->callType = $callType;
        $this->file = $file;
        $this->line = $line;
        $this->stack = $stack;
    }

    /**
     * which class has been executed?
     *
     * @return string|null
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * which function or method has been executed?
     *
     * @return string|null
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * which method has been executed?
     *
     * @return string|null
     */
    public function getMethod()
    {
        if ($this->class === null) {
            return null;
        }
        return $this->function;
    }

    /**
     * how was the function|method called?
     *
     * @return string|null
     */
    public function getCallType()
    {
        return $this->callType;
    }

    /**
     * which file was the executed code defined in?
     *
     * @return string|null
     */
    public function getFilename()
    {
        return $this->file;
    }

    /**
     * which line in $this->getFile() was the executed code defined on?
     *
     * @return int|null
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * what were the contents of the call stack at the time?
     *
     * an empty array means that we weren't asked to save the call stack
     * (probably to save memory - the call stack can be large)
     *
     * @return array
     */
    public function getStack()
    {
        return $this->stack;
    }

    // =========================================================================
    //
    // HELPERS
    //
    // -------------------------------------------------------------------------

    /**
     * return our contents as a sensible, printable string
     *
     * @return string
     */
    public function getExecutedCodeSummary()
    {
        // a class method, a global function, or a PHP script has been executed
        if (isset($this->class)) {
            $retval = $this->class . $this->callType . $this->function . '()';
        }
        else if (isset($this->function)) {
            $retval = $this->function . '()';
        }
        else {
            $retval = $this->file;
        }

        // which line was the caller on?
        if (isset($this->line)) {
            $retval .= "@" . $this->line;
        }

        // all done
        return $retval;
    }

    /**
     * return our contents as a sensible, printable string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getExecutedCodeSummary();
    }
}
