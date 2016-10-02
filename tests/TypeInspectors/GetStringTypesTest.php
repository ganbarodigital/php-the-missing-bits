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
use GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetStringTypes
 */
class GetStringTypesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetStringTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetStringTypes);
    }

    /**
     * @covers ::getStringTypes
     * @covers ::from
     * @covers ::detectNumbers
     * @covers ::fromObject
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::detectNumbers
     * @covers ::fromObject
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetStringTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_string_types
     * @covers ::from
     * @covers ::detectNumbers
     * @covers ::fromObject
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_string_types($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::getStringTypes
     * @covers ::from
     * @covers ::detectNumbers
     * @dataProvider provideCallableStringsToTest
     */
    public function testDetectsCallablesInStrings($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::getStringTypes
     * @covers ::from
     * @covers ::detectNumbers
     * @dataProvider provideNumericStringsToTest
     */
    public function testDetectsNumericStrings($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::fromObject
     * @dataProvider provideStringyObjectsToTest
     */
    public function testDetectsStringyObjects($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetStringTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getStringTypes
     * @covers ::from
     * @dataProvider provideEverythingElseToTest
     */
    public function test_returns_empty_array_for_everything_else($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideCallableStringsToTest(),
            $this->provideNumericStringsToTest(),
            $this->provideRealStringsToTest(),
            $this->provideStringyObjectsToTest(),
            $this->provideEverythingElseToTest()
        );
    }

    public function provideCallableStringsToTest()
    {
        return [
            [
                'gettype',
                [
                    'callable' => 'callable',
                    'string' => 'string',
                ]
            ],
        ];
    }

    public function provideNumericStringsToTest()
    {
        return [
            [
                "0.0",
                [
                    "double" => "double",
                    "string" => "string",
                ]
            ],
            [
                "3.1415927",
                [
                    "double" => "double",
                    "string" => "string",
                ]
            ],

            // examples from the PHP manual
            [
                "1337e0",
                [
                    "double" => "double",
                    "string" => "string",
                ]
            ],

            [
                "0",
                [
                    "integer" => "integer",
                    "string" => "string",
                ]
            ],
            [
                "100",
                [
                    "integer" => "integer",
                    "string" => "string",
                ]
            ],

            // examples from the PHP manual
            [
                "42",
                [
                    "integer" => "integer",
                    "string" => "string",
                ]
            ],
            [
                "02471",
                [
                    "integer" => "integer",
                    "string" => "string",
                ]
            ],
        ];
    }

    public function provideRealStringsToTest()
    {
        return [
            [
                'hello, world!',
                [
                    'string' => 'string',
                ]
            ],
            [
                ArrayObject::class,
                [
                    'string' => 'string',
                ]
            ],
            [
                Traversable::class,
                [
                    'string' => 'string',
                ]
            ],
        ];
    }

    public function provideStringyObjectsToTest()
    {
        return [
            [
                new GetStringTypesTest_StringTarget,
                [
                    'string' => 'string',
                ]
            ],
        ];
    }

    public function provideEverythingElseToTest()
    {
        return [
            [ null,  [] ],
            [ [ 1,2,3 ], [] ],
            [ [ GetStringTypes::class, 'from'], [] ],
            [ true, [] ],
            [ false, [] ],
            [ new ArrayObject(), [] ],
            [ new GetStringTypes(), [] ],
            [ (object)[ 'name' => 'test data'], [] ],
            [ STDIN, [] ],
        ];
    }
}

class GetStringTypesTest_StringTarget
{
    public function __toString()
    {
        // no action required
    }
}
