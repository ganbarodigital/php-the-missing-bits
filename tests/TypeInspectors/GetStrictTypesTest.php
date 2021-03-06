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

use ArrayObject;
use Closure;
use Exception;
use GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetStrictTypes
 */
class GetStrictTypesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetStrictTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetStrictTypes);
    }

    /**
     * @covers ::getStrictTypes
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStrictTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStrictTypes($data);

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

        $actualTypes = GetStrictTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_strict_types
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_strict_types($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideDataToTest()
    {
        $retval = [
            [
                null,
                [
                    'NULL' => 'NULL',
                ]
            ],
            [
                [ 1,2,3 ],
                [
                    'array' => 'array',
                ]
            ],
            [
                [ GetStrictTypes::class, 'from'],
                [
                    'callable' => 'callable',
                    'array' => 'array',
                ]
            ],
            [
                'gettype',
                [
                    'callable' => 'callable',
                    'string' => 'string',
                ]
            ],
            [
                true,
                [
                    'boolean' => 'boolean',
                ]
            ],
            [
                false,
                [
                    'boolean' => 'boolean',
                ]
            ],
            [
                0.0,
                [
                    'double' => 'double',
                ]
            ],
            [
                3.1415927,
                [
                    'double' => 'double',
                ]
            ],
            [
                0,
                [
                    'integer' => 'integer',
                ]
            ],
            [
                100,
                [
                    'integer' => 'integer'
                ]
            ],
            [
                -100,
                [
                    'integer' => 'integer'
                ]
            ],
            [
                new ArrayObject(),
                [
                    ArrayObject::class => ArrayObject::class,
                    'IteratorAggregate' => 'IteratorAggregate',
                    'Traversable' => 'Traversable',
                    'ArrayAccess' => 'ArrayAccess',
                    'Serializable' => 'Serializable',
                    'Countable' => 'Countable',
                ]
            ],
            [
                function(){},
                [
                    Closure::class => Closure::class,
                    'callable' => 'callable',
                ]
            ],
            [
                (object)[ 'name' => 'test data'],
                [
                    'stdClass' => 'stdClass',
                ]
            ],
            [
                STDIN,
                [
                    'resource' => 'resource',
                ]
            ],
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
            [ "100",
                [
                    "integer" => "integer",
                    "string" => "string",
                ]
            ],
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

        if (interface_exists('Throwable')) {
            // PHP 7.0
            $retval[] = [
                new Exception(__FILE__),
                [
                    'Exception' => 'Exception',
                    'Throwable' => 'Throwable',
                    'string' => 'string',
                ]
            ];
        }
        else {
            // PHP 5.x
            $retval[] = [
                new Exception(__FILE__),
                [
                    'Exception' => 'Exception',
                    'string' => 'string',
                ]
            ];
        }

        return $retval;
    }

    /**
     * @covers ::getStrictTypes
     * @covers ::from
     * @dataProvider provideTestClasses
     */
    public function testCanGetInterfaceNames($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetStrictTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getStrictTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideTestClasses()
    {
        return [
            [
                new GetStrictTypesTest_Target1,
                [
                    GetStrictTypesTest_Target1::class => GetStrictTypesTest_Target1::class,
                    GetStrictTypesTest_Interface1::class => GetStrictTypesTest_Interface1::class,
                ]
            ],
            [
                new GetStrictTypesTest_Target2,
                [
                    GetStrictTypesTest_Target2::class => GetStrictTypesTest_Target2::class,
                    GetStrictTypesTest_Interface2::class => GetStrictTypesTest_Interface2::class,
                ]
            ],
            [
                new GetStrictTypesTest_Target1_3,
                [
                    GetStrictTypesTest_Target1_3::class => GetStrictTypesTest_Target1_3::class,
                    GetStrictTypesTest_Target1::class => GetStrictTypesTest_Target1::class,
                    GetStrictTypesTest_Interface1::class => GetStrictTypesTest_Interface1::class,
                    GetStrictTypesTest_Interface3::class => GetStrictTypesTest_Interface3::class,
                ]
            ],
            [
                new GetStrictTypesTest_Target2_3,
                [
                    GetStrictTypesTest_Target2_3::class => GetStrictTypesTest_Target2_3::class,
                    GetStrictTypesTest_Target2::class => GetStrictTypesTest_Target2::class,
                    GetStrictTypesTest_Interface2::class => GetStrictTypesTest_Interface2::class,
                    GetStrictTypesTest_Interface3::class => GetStrictTypesTest_Interface3::class,
                ]
            ],
        ];
    }

    /**
     * @covers ::from
     */
    public function testDetectsCallableArrays()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = [ GetStrictTypes::class, 'from' ];
        $expectedResult = [
            'callable' => 'callable',
            'array' => 'array',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetStrictTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function testDetectsInvokeableObjects()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = function(){};
        $expectedResult = [
            Closure::class => Closure::class,
            'callable' => 'callable',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetStrictTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function testDetectsStringyObjects()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new GetStrictTypesTest_StringTarget;
        $expectedResult = [
            GetStrictTypesTest_StringTarget::class => GetStrictTypesTest_StringTarget::class
        ];
        // HHVM currently adds this class to the class hierarchy
        if (defined('HHVM_VERSION')) {
            $expectedResult['Stringish'] = 'Stringish';
        }
        $expectedResult['string'] = 'string';

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetStrictTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function testDetectsCallableStrings()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = 'is_string';
        $expectedResult = [
            'callable' => 'callable',
            'string' => 'string',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetStrictTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }
}

interface GetStrictTypesTest_Interface1 { }
interface GetStrictTypesTest_Interface2 { }
interface GetStrictTypesTest_Interface3 { }
interface GetStrictTypesTest_Interface4 extends GetStrictTypesTest_Interface1 { }

class GetStrictTypesTest_Target1 implements GetStrictTypesTest_Interface1 { }
class GetStrictTypesTest_Target2 implements GetStrictTypesTest_Interface2 { }
class GetStrictTypesTest_Target1_3 extends GetStrictTypesTest_Target1 implements GetStrictTypesTest_Interface3 { }
class GetStrictTypesTest_Target2_3 extends GetStrictTypesTest_Target2 implements GetStrictTypesTest_Interface3 { }

class GetStrictTypesTest_StringTarget
{
    public function __toString()
    {
        // no action required
    }
}
