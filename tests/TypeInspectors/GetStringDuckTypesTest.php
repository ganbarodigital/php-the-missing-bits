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
use GanbaroDigital\MissingBits\TypeInspectors\GetStringDuckTypes;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetStringDuckTypes
 */
class GetStringDuckTypesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetStringDuckTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetStringDuckTypes);
    }

    /**
     * @covers ::getStringDuckTypes
     * @covers ::from
     * @covers ::detectClassNames
     * @covers ::detectNumbers
     * @covers ::fromObject
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringDuckTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringDuckTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::detectClassNames
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

        $actualTypes = GetStringDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_string_duck_types
     * @covers ::from
     * @covers ::detectClassNames
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

        $actualTypes = get_string_duck_types($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::getStringDuckTypes
     * @covers ::from
     * @covers ::detectNumbers
     * @dataProvider provideCallableStringsToTest
     */
    public function testDetectsCallablesInStrings($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringDuckTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringDuckTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::getStringDuckTypes
     * @covers ::from
     * @covers ::detectNumbers
     * @dataProvider provideNumericStringsToTest
     */
    public function testDetectsNumericStrings($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringDuckTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringDuckTypes($data);

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

        $actualResult = GetStringDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getStringDuckTypes
     * @covers ::from
     * @dataProvider provideEverythingElseToTest
     */
    public function test_returns_empty_array_for_everything_else($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStringDuckTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStringDuckTypes($data);

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
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],
            [
                "3.1415927",
                [
                    "double" => "double",
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],

            // examples from the PHP manual
            [
                "1337e0",
                [
                    "double" => "double",
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],

            [
                "0",
                [
                    "integer" => "integer",
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],
            [
                "100",
                [
                    "integer" => "integer",
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],

            // examples from the PHP manual
            [
                "42",
                [
                    "integer" => "integer",
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],
            [
                "02471",
                [
                    "integer" => "integer",
                    "numeric" => "numeric",
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
                    'ArrayObject' => 'ArrayObject',
                    'IteratorAggregate' => 'IteratorAggregate',
                    'Traversable' => 'Traversable',
                    'ArrayAccess' => 'ArrayAccess',
                    'Serializable' => 'Serializable',
                    'Countable' => 'Countable',
                    'class' => 'class',
                    'string' => 'string',
                ]
            ],
            [
                Traversable::class,
                [
                    'Traversable' => 'Traversable',
                    'interface' => 'interface',
                    'string' => 'string',
                ]
            ],
        ];
    }

    public function provideStringyObjectsToTest()
    {
        return [
            [
                new GetStringDuckTypesTest_StringTarget,
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
            [ [ GetStringDuckTypes::class, 'from'], [] ],
            [ true, [] ],
            [ false, [] ],
            [ new ArrayObject(), [] ],
            [ new GetStringDuckTypes(), [] ],
            [ (object)[ 'name' => 'test data'], [] ],
            [ STDIN, [] ],
        ];
    }
}

class GetStringDuckTypesTest_StringTarget
{
    public function __toString()
    {
        // no action required
    }
}
