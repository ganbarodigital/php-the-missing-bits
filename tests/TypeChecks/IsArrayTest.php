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
 * @package   MissingBits\TypeChecks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\TypeChecks;

use ArrayIterator;
use ArrayObject;
use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\TypeChecks\IsArray;
use GanbaroDigital\UnitTestHelpers\ClassesAndObjects\InvokeMethod;

use IteratorAggregate;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeChecks\IsArray
 */
class IsArrayTest extends PHPUnit_Framework_TestCase
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

        $unit = new IsArray();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof IsArray);
    }

    /**
     * @covers ::check
     */
    public function test_returns_TRUE_for_array()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = [];
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsArray::check($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_FALSE_for_IteratorAggregate()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new IsArrayTest_Target1;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsArray::check($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_FALSE_for_ArrayIterator()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new ArrayIterator([]);
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsArray::check($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_FALSE_for_ArrayObject()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new ArrayObject;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsArray::check($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_FALSE_for_stdClass()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new stdClass;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsArray::check($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     * @dataProvider provideEverythingElse
     */
    public function test_returns_FALSE_for_everything_else($item)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsArray::check($item);

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

        $unit = new IsArray;

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

        $unit = new IsArray;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult1 = $unit->inspect([]);
        $actualResult2 = $unit->inspect(STDIN);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult1);
        $this->assertFalse($actualResult2);
    }

    /**
     * @coversNothing
     */
    public function test_is_ListCheck()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsArray;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(ListCheck::class, $unit);
    }

    /**
     * @covers ::checkList
     * @covers ::inspectList
     */
    public function test_can_use_as_ListCheck()
    {
        // ----------------------------------------------------------------
        // setup your test

        $list1 = [
            []
        ];

        $list2 = [
            STDIN
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult1 = IsArray::checkList($list1);
        $actualResult2 = IsArray::checkList($list2);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult1);
        $this->assertFalse($actualResult2);
    }

    public function provideEverythingElse()
    {
        return [
            [ null ],
            [ true ],
            [ false ],
            [ 3.1415927 ],
            [ 100 ],
            [ "hello world"],
            [ new IsArray ],
        ];
    }
}

// cribbed directly from the PHP manual
class IsArrayTest_Target1 implements IteratorAggregate
{
    public function getIterator()
    {
        return new ArrayIterator([]);
    }
}
