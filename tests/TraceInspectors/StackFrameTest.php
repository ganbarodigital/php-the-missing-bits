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

namespace GanbaroDigitalTest\MissingBits\TraceInspectors;

use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TraceInspectors\StackFrame
 */
class StackFrameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame(null, null, null, null, null);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $unit);
    }

    /**
     * @covers ::__construct
     * @covers ::getClass
     */
    public function testStoresClassnameIfProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = __CLASS__;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualClass = $unit->getClass();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedClass, $actualClass);
    }

    /**
     * @covers ::__construct
     * @covers ::getMethod
     */
    public function testStoresMethodIfProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = __CLASS__;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualMethod = $unit->getMethod();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedMethod, $actualMethod);
    }

    /**
     * @covers ::__construct
     * @covers ::getCallType
     */
    public function testStoresCallTypeIfProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = __CLASS__;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualType = $unit->getCallType();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedType, $actualType);
    }

    /**
     * @covers ::__construct
     * @covers ::getFilename
     */
    public function testStoresFilenameIfProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = __CLASS__;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualFile = $unit->getFilename();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedFile, $actualFile);
    }

    /**
     * @covers ::__construct
     * @covers ::getLine
     */
    public function testStoresLineNumberIfProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = __CLASS__;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualLine = $unit->getLine();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedLine, $actualLine);
    }

    /**
     * @covers ::__construct
     * @covers ::getMethod
     */
    public function testGetMethodReturnsNullIfNoClassProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = null;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualMethod = $unit->getMethod();

        // ----------------------------------------------------------------
        // test the results

        $this->assertNull($actualMethod);
    }

    /**
     * @covers ::__construct
     * @covers ::getFunction
     */
    public function testGetFunctionReturnsFunctionEvenIfNoClassProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = null;
        $expectedMethod = __METHOD__;
        $expectedType = '->';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine);
        $actualMethod = $unit->getFunction();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedMethod, $actualMethod);
    }

    /**
     * @covers ::__construct
     * @covers ::getStack
     */
    public function testStoresCallStackIfProvided()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedClass = null;
        $expectedMethod = __METHOD__;
        $expectedType = '::';
        $expectedFile = __FILE__;
        $expectedLine = __LINE__;
        $expectedStack = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );

        // ----------------------------------------------------------------
        // perform the change

        $unit = new StackFrame($expectedClass, $expectedMethod, $expectedType, $expectedFile, $expectedLine, $expectedStack);
        $actualStack = $unit->getStack();

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedStack, $actualStack);
    }

    /**
     * @covers ::getExecutedCodeSummary
     * @covers ::__toString
     * @dataProvider provideDetails
     */
    public function testCanCoerceToString($class, $method, $type, $file, $line, $expectedCaller)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new StackFrame($class, $method, $type, $file, $line, $expectedCaller);

        // ----------------------------------------------------------------
        // perform the change

        $actualCaller = (string)$unit;

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedCaller, $actualCaller);
    }

    public function provideDetails()
    {
        return [
            [ __CLASS__, __METHOD__, '->', __FILE__, __LINE__, __CLASS__ . '->' . __METHOD__ . '()@' . __LINE__ ],
            [ null, __METHOD__, '::', __FILE__, __LINE__,  __METHOD__ . '()@' . __LINE__ ],
            [ null, null, null, __FILE__, __LINE__, __FILE__ . '@' . __LINE__ ],
        ];
    }
}
