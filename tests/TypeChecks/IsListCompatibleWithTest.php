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
 * @package   MissingBits/TypeChecks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\TypeChecks;

use GanbaroDigital\MissingBits\Checks\CheckList;
use GanbaroDigital\MissingBits\TypeChecks\IsListCompatibleWith;
use GanbaroDigitalTest\MissingBits\DataProviders;
use stdClass;
use TypeError;

// the data providers for our tests
require_once(__DIR__ . '/../_datasets/lists.php');

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeChecks\IsListCompatibleWith
 */
class IsListCompatibleWithTest extends \PHPUnit\Framework\TestCase
{
    use DataProviders\ListDataProviders;

    /**
     * @covers ::__construct
     */
    public function test_can_instantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsListCompatibleWith(self::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof IsListCompatibleWith);
    }

    /**
     * @covers ::using
     * @covers ::inspect
     */
    public function test_supports_fluent_interface()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::using(self::class)->inspect([$this]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     */
    public function test_supports_direct_static_access()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$this], self::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::__construct
     */
    public function test_is_CheckList()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsListCompatibleWith(self::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(CheckList::class, $unit);
    }

    /**
     * @covers ::inspect
     */
    public function test_can_use_as_CheckList()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsListCompatibleWith(self::class);
        $actualResult = $unit->inspect([$this]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideNonLists
     */
    public function test_throws_TypeError_for_non_lists($nonList)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $caughtException = false;
        try {
            IsListCompatibleWith::check($nonList, self::class);
        }
        catch (TypeError $e) {
            $caughtException = true;
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($caughtException);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideClassNamesCompatibleWithClassNamesToTest
     */
    public function test_returns_true_for_classnames_compatible_with_classnames($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(class_exists($data));
        $this->assertTrue(class_exists($constraint) || interface_exists($constraint));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$data], $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideClassNamesCompatibleWithObjectsToTest
     */
    public function test_returns_true_for_classnames_compatible_with_objects($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(class_exists($data));
        $this->assertTrue(is_object($constraint));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$data], $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideObjectsCompatibleWithObjectsToTest
     */
    public function test_returns_true_for_objects_compatible_with_objects($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_object($data));
        $this->assertTrue(is_object($constraint));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$data], $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideObjectsCompatibleWithClassNamesToTest
     */
    public function test_returns_true_for_objects_compatible_with_classnames($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_object($data));
        $this->assertTrue(class_exists($constraint) || interface_exists($constraint));

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$data], $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideIncompatibleClassNamesToTest
     */
    public function test_returns_false_for_incompatible_classnames($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$data], $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideBadData
     */
    public function test_returns_false_for_everything_else($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListCompatibleWith::check([$data], $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     * @dataProvider provideBadConstraints
     */
    public function test_throws_TypeError_for_bad_constraint($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        $caughtException = false;

        // ----------------------------------------------------------------
        // perform the change

        try {
            IsListCompatibleWith::check([$data], $constraint);
        }
        catch (TypeError $e) {
            $caughtException = true;
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($caughtException);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideClassNamesCompatibleWithClassNamesToTest(),
            $this->provideClassNamesCompatibleWithObjectsToTest(),
            $this->provideObjectsCompatibleWithObjectsToTest(),
            $this->provideObjectsCompatibleWithClassNamesToTest(),
            $this->provideIncompatibleClassNamesToTest()
        );
    }

    public function provideClassNamesCompatibleWithClassNamesToTest()
    {
        return [
            [ IsListCompatibleWithTest_Class3::class, IsListCompatibleWithTest_Class1::class, true ],
            [ IsListCompatibleWithTest_Class4::class, IsListCompatibleWithTest_Class2::class, true ],
            [ IsListCompatibleWithTest_Class4::class, IsListCompatibleWith_Interface1::class, true ],
        ];
    }

    public function provideClassNamesCompatibleWithObjectsToTest()
    {
        return [
            [ IsListCompatibleWithTest_Class3::class, new IsListCompatibleWithTest_Class1, true ],
            [ IsListCompatibleWithTest_Class4::class, new IsListCompatibleWithTest_Class2, true ],
        ];
    }

    public function provideObjectsCompatibleWithObjectsToTest()
    {
        return [
            [ new IsListCompatibleWithTest_Class3, new IsListCompatibleWithTest_Class1, true ],
            [ new IsListCompatibleWithTest_Class4, new IsListCompatibleWithTest_Class2, true ],
        ];
    }

    public function provideObjectsCompatibleWithClassNamesToTest()
    {
        return [
            [ new IsListCompatibleWithTest_Class3, IsListCompatibleWithTest_Class1::class, true ],
            [ new IsListCompatibleWithTest_Class4, IsListCompatibleWithTest_Class2::class, true ],
            [ new IsListCompatibleWithTest_Class4, IsListCompatibleWith_Interface1::class, true ]
        ];
    }

    public function provideIncompatibleClassNamesToTest()
    {
        return [
            [ IsListCompatibleWithTest_Class4::class, IsListCompatibleWithTest_Class1::class, false ],
            [ IsListCompatibleWithTest_Class3::class, IsListCompatibleWithTest_Class2::class, false ],
        ];
    }

    public function provideBadData()
    {
        return [
            [ null, IsListCompatibleWithTest_Class1::class ],
            [ [ IsListCompatibleWith::class ], IsListCompatibleWithTest_Class1::class ],
            [ true, IsListCompatibleWithTest_Class1::class ],
            [ false, IsListCompatibleWithTest_Class1::class ],
            [ 3.1415927, IsListCompatibleWithTest_Class1::class ],
            [ 0, IsListCompatibleWithTest_Class1::class ],
            [ 100, IsListCompatibleWithTest_Class1::class ],
            [ new IsListCompatibleWith(self::class), IsListCompatibleWithTest_Class1::class ],
            [ "hello, world", IsListCompatibleWithTest_Class1::class ],
        ];
    }

    public function provideBadConstraints()
    {
        return [
            [ null, false ],
            [ [ IsListCompatibleWith::class ], false ],
            [ true, false ],
            [ false, false ],
            [ 3.1415927, false ],
            [ 0, false ],
            [ 100, false ],
            [ new IsListCompatibleWith(self::class), false ],
            [ "hello, world", false ],
        ];
    }
}

interface IsListCompatibleWith_Interface1 { }
class IsListCompatibleWithTest_Class1 { }
class IsListCompatibleWithTest_Class2 implements IsListCompatibleWith_Interface1 { }
class IsListCompatibleWithTest_Class3 extends IsListCompatibleWithTest_Class1 { }
class IsListCompatibleWithTest_Class4 extends IsListCompatibleWithTest_Class2 { }
trait IsListCompatibleWith_Trait1 { }
