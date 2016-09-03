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
 * @package   MissingBits\Checks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\Checks;

use stdClass;
use ArrayObject;
use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\Checks\ListableCheck;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\Checks\ListableCheck
 */
class ListableCheckTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNothing
     */
    public function test_can_instantiate_class_that_uses_trait()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new ListableCheckTest_Check;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(Check::class, $unit);
    }

    /**
     * @coversNothing
     */
    public function test_is_part_of_ListCheck_interface()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new ListableCheckTest_Check;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(ListCheck::class, $unit);
    }

    /**
     * @covers ::inspectList
     */
    public function test_can_inspect_an_array_of_data_via_inspectList()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedData = 1.0;
        $unit = new ListableCheckTest_Check;

        // ----------------------------------------------------------------
        // perform the change

        $unit->inspectList([$expectedData]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit->inspectCalled);
        $this->assertEquals($expectedData, $unit->inspectData);
    }

    /**
     * @covers ::inspectList
     */
    public function test_can_inspect_a_Traversable_object_via_inspectList()
    {
        // ----------------------------------------------------------------
        // setup your test

        $fieldName = '$alfred';
        $expectedData = 1.0;
        $unit = new ListableCheckTest_Check;
        $list = new ArrayObject;
        $list[0] = $expectedData;

        // ----------------------------------------------------------------
        // perform the change

        $unit->inspectList($list, $fieldName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit->inspectCalled);
        $this->assertEquals($expectedData, $unit->inspectData);
    }

    /**
     * @covers ::inspectList
     */
    public function test_can_inspect_a_stdClass_object_via_inspectList()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedData = 1.0;
        $unit = new ListableCheckTest_Check;
        $list = new stdClass;
        $list->jones = $expectedData;

        // ----------------------------------------------------------------
        // perform the change

        $unit->inspectList($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit->inspectCalled);
        $this->assertEquals($expectedData, $unit->inspectData);
    }

    /**
     * @covers ::inspectList
     * @expectedException InvalidArgumentException
     * @dataProvider provideNonLists
     */
    public function test_throws_InvalidArgumentException_when_non_list_passed_to_inspectList($list)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new ListableCheckTest_Check;

        // ----------------------------------------------------------------
        // perform the change

        $unit->inspectList($list);

        // ----------------------------------------------------------------
        // test the results
    }

    public function provideNonLists()
    {
        return [
            [ null ],
            [ false ],
            [ true ],
            [ 3.1415927 ],
            [ 100 ],
            [ STDIN ],
            [ "hello, world!" ]
        ];
    }
}

class ListableCheckTest_Check implements Check, ListCheck
{
    use ListableCheck;

    public $inspectCalled = false;
    public $inspectData = null;

    public function inspect($item)
    {
        $this->inspectCalled = true;
        $this->inspectData = $item;

        return true;
    }
}
