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
 * @package   MissingBits/Types
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\TypeInspectors;

use PHPUnit_Framework_TestCase;
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType
 */
class GetPrintableTypeTest extends PHPUnit_Framework_TestCase
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

        $unit = new GetPrintableType;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(GetPrintableType::class, $unit);
    }

    /**
     * @covers ::__invoke
     * @covers ::of
     * @covers ::returnCallableType
     * @covers ::returnObjectType
     * @dataProvider provideTypesToTest
     */
    public function testCanUseAsObject($data, $flags, $expectedType)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetPrintableType;

        // ----------------------------------------------------------------
        // perform the change

        $actualType = $unit($data, $flags);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedType, $actualType);
    }

    /**
     * @covers ::of
     * @covers ::returnCallableType
     * @covers ::returnObjectType
     * @dataProvider provideTypesToTest
     */
    public function testCanCallStatically($data, $flags, $expectedType)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualType = GetPrintableType::of($data, $flags);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedType, $actualType);
    }

    /**
     * @covers \get_printable_type
     * @dataProvider provideTypesToTest
     */
    public function testCanCallAsFunction($data, $flags, $expectedType)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualType = get_printable_type($data, $flags);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedType, $actualType);
    }

    public function provideTypesToTest()
    {
        return [
            [ null, GetPrintableType::FLAG_NONE, 'NULL' ],
            [ [], GetPrintableType::FLAG_NONE, 'array' ],
            [ true, GetPrintableType::FLAG_NONE, 'boolean' ],
            [ false, GetPrintableType::FLAG_NONE, 'boolean' ],
            [ function(){}, GetPrintableType::FLAG_NONE, 'callable' ],
            [ [$this, 'provideTypesToTest'], GetPrintableType::FLAG_NONE, 'callable' ],
            [ [$this, 'provideTypesToTest'], GetPrintableType::FLAG_CALLABLE_DETAILS, 'callable<' . __CLASS__ . '::provideTypesToTest>' ],
            [ 'get_printable_type', GetPrintableType::FLAG_NONE, 'callable' ],
            [ 'get_printable_type', GetPrintableType::FLAG_CALLABLE_DETAILS, 'callable<get_printable_type>' ],
            [ [__CLASS__, 'provideTypesToTest'], GetPrintableType::FLAG_CALLABLE_DETAILS, 'callable<' . __CLASS__ . '::provideTypesToTest>' ],
            [ 0.0, GetPrintableType::FLAG_NONE, 'double' ],
            [ 3.1415927, GetPrintableType::FLAG_NONE, 'double' ],
            [ 0, GetPrintableType::FLAG_NONE, 'integer' ],
            [ 100, GetPrintableType::FLAG_NONE, 'integer' ],
            [ new \stdClass, GetPrintableType::FLAG_NONE, 'object' ],
            [ new \stdClass, GetPrintableType::FLAG_CLASSNAME, 'object<stdClass>' ],
            [ STDIN, GetPrintableType::FLAG_NONE, 'resource' ],
            [ '', GetPrintableType::FLAG_NONE, 'string' ],
        ];
    }
}
