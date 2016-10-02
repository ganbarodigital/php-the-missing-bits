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
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetClassTypes
 */
class GetClassTypesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetClassTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetClassTypes);
    }

    /**
     * @covers ::getClassTypes
     * @covers ::from
     * @covers ::getClassHierarchy
     * @covers ::getInterfaceHierarchy
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetClassTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getClassTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::getClassHierarchy
     * @covers ::getInterfaceHierarchy
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetClassTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_class_types
     * @covers ::from
     * @covers ::getClassHierarchy
     * @covers ::getInterfaceHierarchy
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_class_types($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::getClassHierarchy
     * @covers ::getInterfaceHierarchy
     * @dataProvider provideClassNamesToTest
     */
    public function testDetectsClassnames($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(class_exists($data));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetClassTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @covers ::getClassHierarchy
     * @covers ::getInterfaceHierarchy
     * @dataProvider provideInterfacesToTest
     */
    public function testDetectsInterfaces($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(interface_exists($data));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetClassTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @covers ::getClassHierarchy
     * @covers ::getInterfaceHierarchy
     * @dataProvider provideObjectsToTest
     */
    public function testDetectsObjects($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_object($data));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetClassTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideClassNamesToTest(),
            $this->provideInterfacesToTest(),
            $this->provideObjectsToTest(),
            $this->provideEverythingElseToTest()
        );
    }

    public function provideClassNamesToTest()
    {
        return [
            [
                ArrayObject::class,
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
                GetClassTypesTest_Target1::class,
                [
                    GetClassTypesTest_Target1::class => GetClassTypesTest_Target1::class,
                    GetClassTypesTest_Interface1::class => GetClassTypesTest_Interface1::class,
                ]
            ],
            [
                GetClassTypesTest_Target2::class,
                [
                    GetClassTypesTest_Target2::class => GetClassTypesTest_Target2::class,
                    GetClassTypesTest_Interface2::class => GetClassTypesTest_Interface2::class,
                ]
            ],
            [
                GetClassTypesTest_Target1_3::class,
                [
                    GetClassTypesTest_Target1_3::class => GetClassTypesTest_Target1_3::class,
                    GetClassTypesTest_Target1::class => GetClassTypesTest_Target1::class,
                    GetClassTypesTest_Interface1::class => GetClassTypesTest_Interface1::class,
                    GetClassTypesTest_Interface3::class => GetClassTypesTest_Interface3::class,
                ]
            ],
            [
                GetClassTypesTest_Target2_3::class,
                [
                    GetClassTypesTest_Target2_3::class => GetClassTypesTest_Target2_3::class,
                    GetClassTypesTest_Target2::class => GetClassTypesTest_Target2::class,
                    GetClassTypesTest_Interface2::class => GetClassTypesTest_Interface2::class,
                    GetClassTypesTest_Interface3::class => GetClassTypesTest_Interface3::class,
                ]
            ],
        ];
    }

    public function provideInterfacesToTest()
    {
        return [
            [
                Traversable::class,
                [
                    'Traversable' => 'Traversable',
                ]
            ],
            [
                GetClassTypesTest_Interface1::class,
                [
                    GetClassTypesTest_Interface1::class => GetClassTypesTest_Interface1::class,
                ]
            ],
            [
                GetClassTypesTest_Interface4::class,
                [
                    GetClassTypesTest_Interface4::class => GetClassTypesTest_Interface4::class,
                    GetClassTypesTest_Interface1::class => GetClassTypesTest_Interface1::class,
                ]
            ]
        ];
    }

    public function provideObjectsToTest()
    {
        return [
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
                new GetClassTypes(),
                [
                    GetClassTypes::class => GetClassTypes::class,
                ]
            ],
            [
                (object)[ 'name' => 'test data'],
                [
                    'stdClass' => 'stdClass',
                ]
            ],
        ];
    }

    public function provideEverythingElseToTest()
    {
        return [
            [ null,  [] ],
            [ [ 1,2,3 ], [] ],
            [ [ GetClassTypes::class, 'from'], [] ],
            [ true, [] ],
            [ false, [] ],
            [ 0.0, [] ],
            [ 0, [] ],
            [ 1, [] ],
            [ '100', [] ],
        ];
    }
}

interface GetClassTypesTest_Interface1 { }
interface GetClassTypesTest_Interface2 { }
interface GetClassTypesTest_Interface3 { }
interface GetClassTypesTest_Interface4 extends GetClassTypesTest_Interface1 { }

class GetClassTypesTest_Target1 implements GetClassTypesTest_Interface1 { }
class GetClassTypesTest_Target2 implements GetClassTypesTest_Interface2 { }
class GetClassTypesTest_Target1_3 extends GetClassTypesTest_Target1 implements GetClassTypesTest_Interface3 { }
class GetClassTypesTest_Target2_3 extends GetClassTypesTest_Target2 implements GetClassTypesTest_Interface3 { }

class GetClassTypesTest_StringTarget
{
    public function __toString()
    {
        // no action required
    }
}
