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
 * @package   ExceptionHelpers/V1/Callers
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-mv-exception-helpers
 */

namespace GanbaroDigitalTest\MissingBits\TraceInspectors;

use GanbaroDigital\MissingBits\TraceInspectors\GetCaller;
use GanbaroDigital\MissingBits\TraceInspectors\StackFrame;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TraceInspectors\GetCaller
 */
class GetCallerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @coversNothing
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetCaller;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(GetCaller::class, $unit);
    }

    /**
     * @covers ::getCaller
     * @covers ::from
     */
    public function testCanUseAsObject()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetCaller;
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // ----------------------------------------------------------------
        // perform the change

        $result = $unit->getCaller($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals('ReflectionMethod', $result->getClass());
        $this->assertEquals('invokeArgs', $result->getMethod());
    }

    /**
     * @covers ::from
     */
    public function testCanCallStatically()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // ----------------------------------------------------------------
        // perform the change

        $result = GetCaller::from($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals('ReflectionMethod', $result->getClass());
        $this->assertEquals('invokeArgs', $result->getMethod());
    }

    /**
     * @covers \get_caller_from_trace
     * @covers ::from
     */
    public function testCanCallAsFunction()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // ----------------------------------------------------------------
        // perform the change

        $result = get_caller_from_trace($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals('ReflectionMethod', $result->getClass());
        $this->assertEquals('invokeArgs', $result->getMethod());
    }

    /**
     * @covers \get_caller
     * @covers ::from
     */
    public function testCanCallAsFunctionWithoutTrace()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $result = get_caller();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals('ReflectionMethod', $result->getClass());
        $this->assertEquals('invokeArgs', $result->getMethod());
    }

    /**
     * @covers ::from
     */
    public function testWillReturnGlobalFunctions()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = [
            [
                'file' => __FILE__,
                'line' => __LINE__,
                'function' => "testFunction2",
                'class' => null,
            ],
            [
                'file' => __FILE__,
                'line' => __LINE__,
                'function' => "testFunction",
                'class' => null,
            ],
            [
                'file' => __FILE__,
                'line' => __LINE__,
                'function' => __FUNCTION__,
                'class' => __CLASS__,
            ],
            [
                'file' => __FILE__,
                'line' => __LINE__,
                'function' => __FUNCTION__,
                'class' => __CLASS__,
            ]
        ];

        // ----------------------------------------------------------------
        // perform the change

        $result = GetCaller::from($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals($backtrace[0]['file'], $result->getFilename());
        $this->assertEquals($backtrace[0]['line'], $result->getLine());
        $this->assertEquals($backtrace[1]['function'], $result->getFunction());
    }

    /**
     * @covers ::from
     */
    public function testWillFilterOutNamespaces()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $partials = [
            __CLASS__,
            'ReflectionMethod'
        ];

        $expectedClass = 'PHPUnit\Framework\TestCase';
        $expectedMethod = 'runTest';

        // ----------------------------------------------------------------
        // perform the change

        $result = GetCaller::from($backtrace, $partials);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals($expectedClass, $result->getClass());
        $this->assertEquals($expectedMethod, $result->getMethod());
    }

    /**
     * @covers ::from
     */
    public function testReturnsFirstStackFrameWhenEverythingElseFilteredOut()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $partials = [
            __CLASS__,
            'ReflectionMethod',
            'PHPUnit\Framework\TestCase',
            'PHPUnit\Framework\TestResult',
            'PHPUnit\Framework\TestSuite',
            'PHPUnit\TextUI\TestRunner',
            'PHPUnit\TextUI\Command',
        ];

        $expectedClass = 'ReflectionMethod';
        $expectedMethod = 'invokeArgs';

        // ----------------------------------------------------------------
        // perform the change

        $result = GetCaller::from($backtrace, $partials);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(StackFrame::class, $result);
        $this->assertEquals($expectedClass, $result->getClass());
        $this->assertEquals($expectedMethod, $result->getMethod());
    }
}
