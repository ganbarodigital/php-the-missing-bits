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
use GanbaroDigital\MissingBits\TypeInspectors\GetDuckTypes;
use PHPUnit_Framework_TestCase;
use stdClass;
use Traversable;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetDuckTypes
 */
class GetDuckTypesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetDuckTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetDuckTypes);
    }

    /**
     * @covers ::getDuckTypes
     * @covers ::from
     * @covers ::fromArray
     * @covers ::fromDouble
     * @covers ::fromInteger
     * @covers ::fromObject
     * @covers ::fromString
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetDuckTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getDuckTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::fromArray
     * @covers ::fromDouble
     * @covers ::fromInteger
     * @covers ::fromObject
     * @covers ::fromString
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_duck_types
     * @covers ::from
     * @covers ::fromArray
     * @covers ::fromDouble
     * @covers ::fromInteger
     * @covers ::fromObject
     * @covers ::fromString
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_duck_types($data);

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
                    'Traversable' => 'Traversable',
                    'array' => 'array',
                ]
            ],
            [
                [ GetDuckTypes::class, 'from'],
                [
                    'callable' => 'callable',
                    'Traversable' => 'Traversable',
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
                    "numeric" => "numeric",
                ]
            ],
            [
                3.1415927,
                [
                    'double' => 'double',
                    "numeric" => "numeric",
                ]
            ],
            [
                0,
                [
                    'integer' => 'integer',
                    "numeric" => "numeric",
                ]
            ],
            [
                100,
                [
                    'integer' => 'integer',
                    "numeric" => "numeric",
                ]
            ],
            [
                -100,
                [
                    'integer' => 'integer',
                    "numeric" => "numeric",
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
                    'object' => 'object',
                ]
            ],
            [
                function(){},
                [
                    Closure::class => Closure::class,
                    'callable' => 'callable',
                    'object' => 'object',
                ]
            ],
            [
                (object)[ 'name' => 'test data'],
                [
                    'stdClass' => 'stdClass',
                    'Traversable' => 'Traversable',
                    'object' => 'object',
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
            [ "100",
                [
                    "integer" => "integer",
                    "numeric" => "numeric",
                    "string" => "string",
                ]
            ],
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
            [
                ArrayObject::class,
                [
                    ArrayObject::class => ArrayObject::class,
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
                    Traversable::class => Traversable::class,
                    'interface' => 'interface',
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
                    'object' => 'object'
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
                    'object' => 'object'
                ]
            ];
        }

        return $retval;
    }

    /**
     * @covers ::getDuckTypes
     * @covers ::from
     * @covers ::fromString
     * @dataProvider provideTestClasses
     */
    public function testCanGetInterfaceNames($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetDuckTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getDuckTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideTestClasses()
    {
        return [
            [
                new GetDuckTypesTest_Target1,
                [
                    GetDuckTypesTest_Target1::class => GetDuckTypesTest_Target1::class,
                    GetDuckTypesTest_Interface1::class => GetDuckTypesTest_Interface1::class,
                    'object' => 'object',
                ]
            ],
            [
                new GetDuckTypesTest_Target2,
                [
                    GetDuckTypesTest_Target2::class => GetDuckTypesTest_Target2::class,
                    GetDuckTypesTest_Interface2::class => GetDuckTypesTest_Interface2::class,
                    'object' => 'object',
                ]
            ],
            [
                new GetDuckTypesTest_Target1_3,
                [
                    GetDuckTypesTest_Target1_3::class => GetDuckTypesTest_Target1_3::class,
                    GetDuckTypesTest_Target1::class => GetDuckTypesTest_Target1::class,
                    GetDuckTypesTest_Interface1::class => GetDuckTypesTest_Interface1::class,
                    GetDuckTypesTest_Interface3::class => GetDuckTypesTest_Interface3::class,
                    'object' => 'object',
                ]
            ],
            [
                new GetDuckTypesTest_Target2_3,
                [
                    GetDuckTypesTest_Target2_3::class => GetDuckTypesTest_Target2_3::class,
                    GetDuckTypesTest_Target2::class => GetDuckTypesTest_Target2::class,
                    GetDuckTypesTest_Interface2::class => GetDuckTypesTest_Interface2::class,
                    GetDuckTypesTest_Interface3::class => GetDuckTypesTest_Interface3::class,
                    'object' => 'object',
                ]
            ],
        ];
    }

    /**
     * @covers ::fromArray
     */
    public function testDetectsCallableArrays()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = [ GetDuckTypes::class, 'from' ];
        $expectedResult = [
            'callable' => 'callable',
            'Traversable' => 'Traversable',
            'array' => 'array',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::fromObject
     */
    public function testDetectsInvokeableObjects()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = function(){};
        $expectedResult = [
            Closure::class => Closure::class,
            'callable' => 'callable',
            'object' => 'object',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::fromObject
     */
    public function testDetectsStringyObjects()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new GetDuckTypesTest_StringTarget;
        $expectedResult = [
            GetDuckTypesTest_StringTarget::class => GetDuckTypesTest_StringTarget::class
        ];
        // HHVM currently adds this class to the class hierarchy
        if (defined('HHVM_VERSION')) {
            $expectedResult['Stringish'] = 'Stringish';
        }
        $expectedResult = array_merge($expectedResult, [
            'string' => 'string',
            'object' => 'object',
        ]);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::fromObject
     * @covers ::getObjectSpecialTypes
     */
    public function test_treats_stdClass_as_Traversable()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new stdClass;
        $expectedResult = [
            'stdClass' => 'stdClass',
            'Traversable' => 'Traversable',
            'object' => 'object',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::fromString
     */
    public function testDetectsStringyClassnames()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = GetDuckTypesTest_StringTarget::class;
        $expectedResult = [
            GetDuckTypesTest_StringTarget::class => GetDuckTypesTest_StringTarget::class,
            'class' => 'class',
            'string' => 'string',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::fromString
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

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::fromString
     */
    public function testDetectsInterfaces()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = 'Traversable';
        $expectedResult = [
            'Traversable' => 'Traversable',
            'interface' => 'interface',
            'string' => 'string',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetDuckTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }
}

interface GetDuckTypesTest_Interface1 { }
interface GetDuckTypesTest_Interface2 { }
interface GetDuckTypesTest_Interface3 { }
interface GetDuckTypesTest_Interface4 extends GetDuckTypesTest_Interface1 { }

class GetDuckTypesTest_Target1 implements GetDuckTypesTest_Interface1 { }
class GetDuckTypesTest_Target2 implements GetDuckTypesTest_Interface2 { }
class GetDuckTypesTest_Target1_3 extends GetDuckTypesTest_Target1 implements GetDuckTypesTest_Interface3 { }
class GetDuckTypesTest_Target2_3 extends GetDuckTypesTest_Target2 implements GetDuckTypesTest_Interface3 { }

class GetDuckTypesTest_StringTarget
{
    public function __toString()
    {
        // no action required
    }
}
