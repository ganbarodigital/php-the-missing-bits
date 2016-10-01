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

use GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TraceInspectors\FilterBacktrace
 */
class FilterBacktraceTest extends PHPUnit_Framework_TestCase
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

        $unit = new FilterBacktrace;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(FilterBacktrace::class, $unit);
    }

    /**
     * @covers ::filterBacktrace
     * @covers ::from
     * @covers ::isClassNameOkay
     * @covers ::extractFrameDetails
     */
    public function testCanUseAsObject()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new FilterBacktrace;
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // ----------------------------------------------------------------
        // perform the change

        $result = $unit->filterBacktrace($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('function', $result);
        $this->assertEquals('invokeArgs', $result['function']);
        $this->assertArrayHasKey('class', $result);
        $this->assertEquals('ReflectionMethod', $result['class']);
    }

    /**
     * @covers ::from
     * @covers ::isClassNameOkay
     * @covers ::extractFrameDetails
     */
    public function testCanCallStatically()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // ----------------------------------------------------------------
        // perform the change

        $result = FilterBacktrace::from($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('function', $result);
        $this->assertEquals('invokeArgs', $result['function']);
        $this->assertArrayHasKey('class', $result);
        $this->assertEquals('ReflectionMethod', $result['class']);
    }

    /**
     * @covers ::from
     * @covers ::extractFrameDetails
     */
    public function testWillReturnGlobalFunctions()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = foo();

        $expectedFrame = [
            'file' => $backtrace[0]['file'],
            'line' => $backtrace[0]['line'],
            'class' => null,
            'function' => $backtrace[1]['function'],
            'type' => null,
            'stackIndex' => 1,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualFrame = FilterBacktrace::from($backtrace);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedFrame, $actualFrame);
    }

    /**
     * @covers ::isClassNameOkay
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

        $expectedClass = 'PHPUnit_Framework_TestCase';
        $expectedMethod = 'runTest';

        // ----------------------------------------------------------------
        // perform the change

        $actualFrame = FilterBacktrace::from($backtrace, $partials);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedClass, $actualFrame['class']);
        $this->assertEquals($expectedMethod, $actualFrame['function']);
    }

    /**
     * @covers ::from
     * @covers ::extractFrameDetails
     */
    public function testReturnsFirstStackFrameWhenEverythingElseFilteredOut()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $partials = [
            __CLASS__,
            'ReflectionMethod',
            'PHPUnit_Framework_TestCase',
            'PHPUnit_Framework_TestResult',
            'PHPUnit_Framework_TestSuite',
            'PHPUnit_TextUI_TestRunner',
            'PHPUnit_TextUI_Command',
        ];

        $expectedClass = 'ReflectionMethod';
        $expectedMethod = 'invokeArgs';

        // ----------------------------------------------------------------
        // perform the change

        $actualFrame = FilterBacktrace::from($backtrace, $partials);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedClass, $actualFrame['class']);
        $this->assertEquals($expectedMethod, $actualFrame['function']);
    }

    /**
     * @covers ::from
     * @covers ::extractFrameDetails
     */
    public function testCanSearchFromAnywhereInTheStack()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $partials = [];

        $expectedClass = "PHPUnit_Framework_TestCase";
        $expectedMethod = "runTest";

        // ----------------------------------------------------------------
        // perform the change

        $actualFrame = FilterBacktrace::from($backtrace, $partials, 2);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedClass, $actualFrame['class']);
        $this->assertEquals($expectedMethod, $actualFrame['function']);
    }

    /**
     * @covers ::from
     * @covers ::extractFrameDetails
     */
    public function testReturnsLastStackFrameWhenStartingSearchBeyondTheStack()
    {
        // ----------------------------------------------------------------
        // setup your test

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $partials = [];

        $expectedClass = "PHPUnit_TextUI_Command";
        $expectedMethod = "main";

        // ----------------------------------------------------------------
        // perform the change

        $actualFrame = FilterBacktrace::from($backtrace, $partials, 300);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedClass, $actualFrame['class']);
        $this->assertEquals($expectedMethod, $actualFrame['function']);
    }
}

// test helpers
class foo
{
    public static function bar()
    {
        return debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    }
}
function foo()
{
    // the PHP debug_backtrace() stack frames are skewed, with some of the
    // information in one stack frame, and some more of the information in
    // the next stack frame
    //
    // this makes the very first stack frame a tricky thing to deal with
    return foo::bar();
}
