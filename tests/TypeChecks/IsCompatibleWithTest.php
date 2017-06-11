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

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\TypeChecks\IsCompatibleWith;
use stdClass;
use TypeError;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeChecks\IsCompatibleWith
 */
class IsCompatibleWithTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::__construct
     */
    public function test_can_instantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsCompatibleWith(self::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof IsCompatibleWith);
    }

    /**
     * @covers ::using
     */
    public function test_supports_fluent_interface()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsCompatibleWith::using(self::class)->inspect($this);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_supports_direct_static_access()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsCompatibleWith::check($this, self::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::__construct
     */
    public function test_is_Check()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsCompatibleWith(self::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(Check::class, $unit);
    }

    /**
     * @covers ::inspect
     */
    public function test_can_use_as_Check()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsCompatibleWith(self::class);
        $actualResult = $unit->inspect($this);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::checkString
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

        $actualResult = IsCompatibleWith::check($data, $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::checkString
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

        $actualResult = IsCompatibleWith::check($data, $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::checkObject
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

        $actualResult = IsCompatibleWith::check($data, $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::checkObject
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

        $actualResult = IsCompatibleWith::check($data, $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::checkObject
     * @covers ::checkString
     * @dataProvider provideIncompatibleClassNamesToTest
     */
    public function test_returns_false_for_incompatible_classnames($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsCompatibleWith::check($data, $constraint);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     * @dataProvider provideBadData
     */
    public function test_returns_false_for_everything_else($data, $constraint)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsCompatibleWith::check($data, $constraint);

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
            IsCompatibleWith::check($data, $constraint);
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
            [ IsCompatibleWithTest_Class3::class, IsCompatibleWithTest_Class1::class, true ],
            [ IsCompatibleWithTest_Class4::class, IsCompatibleWithTest_Class2::class, true ],
            [ IsCompatibleWithTest_Class4::class, IsCompatibleWith_Interface1::class, true ],
        ];
    }

    public function provideClassNamesCompatibleWithObjectsToTest()
    {
        return [
            [ IsCompatibleWithTest_Class3::class, new IsCompatibleWithTest_Class1, true ],
            [ IsCompatibleWithTest_Class4::class, new IsCompatibleWithTest_Class2, true ],
        ];
    }

    public function provideObjectsCompatibleWithObjectsToTest()
    {
        return [
            [ new IsCompatibleWithTest_Class3, new IsCompatibleWithTest_Class1, true ],
            [ new IsCompatibleWithTest_Class4, new IsCompatibleWithTest_Class2, true ],
        ];
    }

    public function provideObjectsCompatibleWithClassNamesToTest()
    {
        return [
            [ new IsCompatibleWithTest_Class3, IsCompatibleWithTest_Class1::class, true ],
            [ new IsCompatibleWithTest_Class4, IsCompatibleWithTest_Class2::class, true ],
            [ new IsCompatibleWithTest_Class4, IsCompatibleWith_Interface1::class, true ]
        ];
    }

    public function provideIncompatibleClassNamesToTest()
    {
        return [
            [ IsCompatibleWithTest_Class4::class, IsCompatibleWithTest_Class1::class, false ],
            [ IsCompatibleWithTest_Class3::class, IsCompatibleWithTest_Class2::class, false ],
        ];
    }

    public function provideBadData()
    {
        return [
            [ null, IsCompatibleWithTest_Class1::class ],
            [ [ IsCompatibleWith::class ], IsCompatibleWithTest_Class1::class ],
            [ true, IsCompatibleWithTest_Class1::class ],
            [ false, IsCompatibleWithTest_Class1::class ],
            [ 3.1415927, IsCompatibleWithTest_Class1::class ],
            [ 0, IsCompatibleWithTest_Class1::class ],
            [ 100, IsCompatibleWithTest_Class1::class ],
            [ new IsCompatibleWith(self::class), IsCompatibleWithTest_Class1::class ],
            [ "hello, world", IsCompatibleWithTest_Class1::class ],
        ];
    }

    public function provideBadConstraints()
    {
        return [
            [ null, false ],
            [ [ IsCompatibleWith::class ], false ],
            [ true, false ],
            [ false, false ],
            [ 3.1415927, false ],
            [ 0, false ],
            [ 100, false ],
            [ new IsCompatibleWith(self::class), false ],
            [ "hello, world", false ],
        ];
    }
}

interface IsCompatibleWith_Interface1 { }
class IsCompatibleWithTest_Class1 { }
class IsCompatibleWithTest_Class2 implements IsCompatibleWith_Interface1 { }
class IsCompatibleWithTest_Class3 extends IsCompatibleWithTest_Class1 { }
class IsCompatibleWithTest_Class4 extends IsCompatibleWithTest_Class2 { }
trait IsCompatibleWith_Trait1 { }
