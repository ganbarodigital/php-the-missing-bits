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
use GanbaroDigital\MissingBits\TypeInspectors\GetClassTraits;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetClassTraits
 */
class GetClassTraitsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetClassTraits();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetClassTraits);
    }

    /**
     * @covers ::__invoke
     * @covers ::from
     * @covers ::getTraits
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetClassTraits();

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
     * @covers ::getTraits
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetClassTraits::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_class_traits
     * @covers ::__invoke
     * @covers ::from
     * @covers ::getTraits
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_class_traits($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @covers ::getTraits
     * @dataProvider provideClassNamesToTest
     */
    public function testDetectsTraitsUsedByClasses($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(class_exists($data));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetClassTraits::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @covers ::getTraits
     * @dataProvider provideObjectsToTest
     */
    public function testDetectsTraitsUsedByObjects($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_object($data));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetClassTraits::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @covers ::getTraits
     * @dataProvider provideEverythingElseToTest
     */
    public function testReturnsEmptyArrayForEverythingElse($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetClassTraits::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideClassNamesToTest(),
            $this->provideObjectsToTest(),
            $this->provideEverythingElseToTest()
        );
    }

    public function provideClassNamesToTest()
    {
        return [
            [
                GetClassTraitsTest_Class1::class,
                [
                    GetClassTraitsTest_Trait1::class => GetClassTraitsTest_Trait1::class,
                ]
            ],
            [
                GetClassTraitsTest_Class2::class,
                [
                    GetClassTraitsTest_Trait1::class => GetClassTraitsTest_Trait1::class,
                    GetClassTraitsTest_Trait2::class => GetClassTraitsTest_Trait2::class,
                ]
            ],
            [
                GetClassTraitsTest_Class3::class,
                [
                    GetClassTraitsTest_Trait1::class => GetClassTraitsTest_Trait1::class,
                    GetClassTraitsTest_Trait2::class => GetClassTraitsTest_Trait2::class,
                    GetClassTraitsTest_Trait3::class => GetClassTraitsTest_Trait3::class,
                ]
            ],
            [
                GetClassTraitsTest_Class4::class,
                [
                    GetClassTraitsTest_Trait3::class => GetClassTraitsTest_Trait3::class,
                    GetClassTraitsTest_Trait4::class => GetClassTraitsTest_Trait4::class,
                ]
            ],
        ];
    }

    public function provideObjectsToTest()
    {
        return [
            [
                new GetClassTraitsTest_Class1,
                [
                    GetClassTraitsTest_Trait1::class => GetClassTraitsTest_Trait1::class,
                ]
            ],
            [
                new GetClassTraitsTest_Class2,
                [
                    GetClassTraitsTest_Trait1::class => GetClassTraitsTest_Trait1::class,
                    GetClassTraitsTest_Trait2::class => GetClassTraitsTest_Trait2::class,
                ]
            ],
            [
                new GetClassTraitsTest_Class3,
                [
                    GetClassTraitsTest_Trait1::class => GetClassTraitsTest_Trait1::class,
                    GetClassTraitsTest_Trait2::class => GetClassTraitsTest_Trait2::class,
                    GetClassTraitsTest_Trait3::class => GetClassTraitsTest_Trait3::class,
                ]
            ],
            [
                new GetClassTraitsTest_Class4,
                [
                    GetClassTraitsTest_Trait3::class => GetClassTraitsTest_Trait3::class,
                    GetClassTraitsTest_Trait4::class => GetClassTraitsTest_Trait4::class,
                ]
            ],
        ];
    }

    public function provideEverythingElseToTest()
    {
        return [
            [ null,  [] ],
            [ [ 1,2,3 ], [] ],
            [ [ GetClassTraits::class, 'from'], [] ],
            [ true, [] ],
            [ false, [] ],
            [ 0.0, [] ],
            [ 0, [] ],
            [ 1, [] ],
            [ ArrayObject::class, [] ],
            [ new ArrayObject, [] ],
            [ '100', [] ],
        ];
    }
}

trait GetClassTraitsTest_Trait1
{
    public function foo1()
    {
        return null;
    }
}

trait GetClassTraitsTest_Trait2
{
    public function foo2()
    {
        return null;
    }
}

trait GetClassTraitsTest_Trait3
{
    public function foo3()
    {
        return null;
    }
}

trait GetClassTraitsTest_Trait4
{
    // to prove that we can detect traits inside traits
    use GetClassTraitsTest_Trait3;

    public function foo3()
    {
        return null;
    }
}

class GetClassTraitsTest_Class1
{
    use GetClassTraitsTest_Trait1;
}

class GetClassTraitsTest_Class2 extends GetClassTraitsTest_Class1
{
    use GetClassTraitsTest_Trait2;
}

class GetClassTraitsTest_Class3 extends GetClassTraitsTest_Class2
{
    use GetClassTraitsTest_Trait3;
}

class GetClassTraitsTest_Class4
{
    use GetClassTraitsTest_Trait4;
}
