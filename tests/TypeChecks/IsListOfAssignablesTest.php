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

use stdClass;
use GanbaroDigital\MissingBits\Checks\CheckList;
use GanbaroDigital\MissingBits\TypeChecks\IsListOfAssignables;
use TypeError;

// load the available test datasets
require_once __DIR__ . '/../Datasets/datasets.inc.php';

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeChecks\IsListOfAssignables
 */
class IsListOfAssignablesTest extends \PHPUnit\Framework\TestCase
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

        $unit = new IsListOfAssignables;

        // ----------------------------------------------------------------
        // test the results
        //
        // explain what you expect to have happened

        $this->assertInstanceOf(IsListOfAssignables::class, $unit);
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

        $unit = IsListOfAssignables::using();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(IsListOfAssignables::class, $unit);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider ListDataset::provideNonLists
     */
    public function test_throws_TypeError_for_non_lists($nonList)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $caughtException = false;
        try {
            IsListOfAssignables::check($nonList);
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
     */
    public function test_returns_true_for_stdClass()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new stdClass;
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfAssignables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     */
    public function test_returns_true_for_objects_with_public_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new IsListOfAssignablesTest_HasPublicProps;
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfAssignables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     */
    public function test_returns_false_for_objects_without_public_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new IsListOfAssignablesTest_NoProps;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfAssignables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideNonAssignables
     */
    public function test_returns_false_for_everything_else($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfAssignables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
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

        $unit = new IsListOfAssignables();

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(CheckList::class, $unit);
    }

    /**
     * @covers ::using
     * @covers ::inspect
     */
    public function test_can_use_as_CheckList()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult1 = IsListOfAssignables::using()->inspect([
            new IsListOfAssignablesTest_HasPublicProps
        ]);
        $actualResult2 = IsListOfAssignables::using()->inspect([
            new IsListOfAssignablesTest_NoProps
        ]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult1);
        $this->assertFalse($actualResult2);
    }

    public function provideNonAssignables()
    {
        return [
            [ null ],
            [ false ],
            [ true ],
            [ [ ] ],
            [ 3.1415927 ],
            [ 100 ],
            [ "hello, world" ],
        ];
    }
}

class IsListOfAssignablesTest_HasPublicProps
{
    public $objProp1 = 1;
}

class IsListOfAssignablesTest_NoProps
{

}
