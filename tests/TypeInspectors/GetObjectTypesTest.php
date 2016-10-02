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
use GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetObjectTypes
 */
class GetObjectTypesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetObjectTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetObjectTypes);
    }

    /**
     * @covers ::getObjectTypes
     * @covers ::from
     * @covers ::getObjectConditionalTypes
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetObjectTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getObjectTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::getObjectConditionalTypes
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetObjectTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_object_types
     * @covers ::from
     * @covers ::getObjectConditionalTypes
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_object_types($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::getObjectTypes
     * @covers ::from
     * @covers ::getObjectConditionalTypes
     * @dataProvider provideTestClasses
     */
    public function testCanGetInterfaceNames($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetObjectTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getObjectTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideTestClasses()
    {
        return [
            [
                new GetObjectTypesTest_Target1,
                [
                    GetObjectTypesTest_Target1::class => GetObjectTypesTest_Target1::class,
                    GetObjectTypesTest_Interface1::class => GetObjectTypesTest_Interface1::class,
                ]
            ],
            [
                new GetObjectTypesTest_Target2,
                [
                    GetObjectTypesTest_Target2::class => GetObjectTypesTest_Target2::class,
                    GetObjectTypesTest_Interface2::class => GetObjectTypesTest_Interface2::class,
                ]
            ],
            [
                new GetObjectTypesTest_Target1_3,
                [
                    GetObjectTypesTest_Target1_3::class => GetObjectTypesTest_Target1_3::class,
                    GetObjectTypesTest_Target1::class => GetObjectTypesTest_Target1::class,
                    GetObjectTypesTest_Interface1::class => GetObjectTypesTest_Interface1::class,
                    GetObjectTypesTest_Interface3::class => GetObjectTypesTest_Interface3::class,
                ]
            ],
            [
                new GetObjectTypesTest_Target2_3,
                [
                    GetObjectTypesTest_Target2_3::class => GetObjectTypesTest_Target2_3::class,
                    GetObjectTypesTest_Target2::class => GetObjectTypesTest_Target2::class,
                    GetObjectTypesTest_Interface2::class => GetObjectTypesTest_Interface2::class,
                    GetObjectTypesTest_Interface3::class => GetObjectTypesTest_Interface3::class,
                ]
            ],
        ];
    }

    /**
     * @covers ::from
     * @covers ::getObjectConditionalTypes
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

        $actualResult = GetObjectTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @covers ::getObjectConditionalTypes
     */
    public function testDetectsStringyObjects()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new GetObjectTypesTest_StringTarget;
        $expectedResult = [
            GetObjectTypesTest_StringTarget::class => GetObjectTypesTest_StringTarget::class
        ];
        // HHVM currently adds this class to the class hierarchy
        if (defined('HHVM_VERSION')) {
            $expectedResult['Stringish'] = 'Stringish';
        }
        $expectedResult['string'] = 'string';

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetObjectTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::getObjectTypes
     * @covers ::from
     * @covers ::getObjectConditionalTypes
     * @dataProvider provideEverythingElseToTest
     */
    public function testReturnsEmptyArrayForNonObjects($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetObjectTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getObjectTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideObjectsToTest(),
            $this->provideEverythingElseToTest()
        );
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
        ];
    }

    public function provideEverythingElseToTest()
    {
        return [
            [ null,  [] ],
            [ [ 1,2,3 ], [] ],
            [ [ GetObjectTypes::class, 'from'], [] ],
            [ true, [] ],
            [ false, [] ],
            [ 0.0, [] ],
            [ 0, [] ],
            [ 1, [] ],
            [ '100', [] ],
            [ ArrayObject::class, [] ],
        ];
    }
}

interface GetObjectTypesTest_Interface1 { }
interface GetObjectTypesTest_Interface2 { }
interface GetObjectTypesTest_Interface3 { }
interface GetObjectTypesTest_Interface4 extends GetObjectTypesTest_Interface1 { }

class GetObjectTypesTest_Target1 implements GetObjectTypesTest_Interface1 { }
class GetObjectTypesTest_Target2 implements GetObjectTypesTest_Interface2 { }
class GetObjectTypesTest_Target1_3 extends GetObjectTypesTest_Target1 implements GetObjectTypesTest_Interface3 { }
class GetObjectTypesTest_Target2_3 extends GetObjectTypesTest_Target2 implements GetObjectTypesTest_Interface3 { }

class GetObjectTypesTest_StringTarget
{
    public function __toString()
    {
        // no action required
    }
}
