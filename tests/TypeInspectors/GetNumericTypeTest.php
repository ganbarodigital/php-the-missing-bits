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
 * @package   MissingBits/Types
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\TypeInspectors;

use Traversable;
use ArrayObject;
use GanbaroDigital\MissingBits\TypeInspectors\GetNumericType;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetNumericType
 */
class GetNumericTypeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetNumericType();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetNumericType);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetNumericType();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetNumericType::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_numeric_type
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_numeric_type($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideRealIntegersToTest
     */
    public function testDetectsRealIntegers($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetNumericType();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideRealDoublesToTest
     */
    public function testDetectsRealDoubles($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetNumericType();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideNumericStringsToTest
     */
    public function testDetectsNumericStrings($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetNumericType();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @dataProvider provideEverythingElseToTest
     */
    public function test_returns_NULL_for_everything_else($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetNumericType();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideRealDoublesToTest(),
            $this->provideRealIntegersToTest(),
            $this->provideNumericStringsToTest(),
            $this->provideEverythingElseToTest()
        );
    }

    public function provideRealDoublesToTest()
    {
        return [
            [ 0.0, "double" ],
            [ 3.1415927, "double" ],

            // examples from the PHP manual
            [ 1337e0, "double" ],
        ];
    }

    public function provideRealIntegersToTest()
    {
        return [
            [ 0, "integer" ],
            [ 100, "integer" ],

            // examples from the PHP manual
            [ 42, "integer" ],
            [ 02471, "integer" ],
            [ 0b10100111001, "integer" ]
        ];
    }

    public function provideNumericStringsToTest()
    {
        // we cannot simply call provideRealDoublesToTest(), as PHP will
        // convert some of those doubles to integers
        $retval = [
            [ "0.0", "double" ],
            [ "3.1415927", "double" ],

            // examples from the PHP manual
            [ "1337e0", "double" ],
        ];
        foreach ($this->provideRealIntegersToTest() as $args) {
            $retval[] = [ "" . $args[0], $args[1] ];
        }

        return $retval;
    }

    public function provideEverythingElseToTest()
    {
        return [
            [ null,  null ],
            [ [ 1,2,3 ], null ],
            [ [ GetNumericType::class, 'from'], null ],
            [ true, null ],
            [ false, null ],
            [ new ArrayObject(), null ],
            [ new GetNumericType(), null ],
            [ (object)[ 'name' => 'test data'], null ],
            [ STDIN, null ],
            [ 'hello, world!', null ],
            [ ArrayObject::class, null ],
            [ Traversable::class, null ],
        ];
    }
}
