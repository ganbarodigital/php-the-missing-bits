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
 * @package   MissingBits/ClassesAndObjects
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\ClassesAndObjects;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty;
use ReflectionClass;
use ReflectionProperty;

 /**
  * @coversDefaultClass GanbaroDigital\MissingBits\ClassesAndObjects\IsClassProperty
  */
class IsClassPropertyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @coversNothing
     */
    public function test_can_instantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsClassProperty;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(IsClassProperty::class, $unit);
    }

    /**
     * @covers ::using
     */
    public function test_supports_fluent_interface()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('staticPublic');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::using()->inspect($refProp);

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

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('staticPublic');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_for_static_public_property()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('staticPublic');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_for_static_protected_property()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('staticProtected');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_for_static_private_property()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('staticPrivate');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_false_for_non_static_public_property()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('objPublic');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_false_for_non_static_protected_property()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('objProtected');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_false_for_non_static_private_property()
    {
        // ----------------------------------------------------------------
        // setup your test

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('objPrivate');

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsClassProperty::check($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @coversNothing
     */
    public function test_is_Check()
    {
        // ----------------------------------------------------------------
        // setup your test


        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsClassProperty;

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

        $refObj = new ReflectionClass(IsClassPropertyTest_Target::class);
        $refProp = $refObj->getProperty('staticPublic');

        $unit = new IsClassProperty;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->inspect($refProp);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }
}

class IsClassPropertyTest_Target
{
    public static $staticPublic = 1;
    protected static $staticProtected = 2;
    private static $staticPrivate = 3;

    public $objPublic = 1;
    public $objProtected = 2;
    public $objPrivate = 3;
}
