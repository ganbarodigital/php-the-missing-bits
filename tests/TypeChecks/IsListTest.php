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

use ArrayObject;
use Closure;
use stdClass;
use Traversable;
use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\Checks\ListCheck;
use GanbaroDigital\MissingBits\TypeChecks\IsList;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeChecks\IsList
 */
class IsListTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::check
     */
    public function test_array_returns_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = [
            11,
            12,
            13,
            14
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsList::check($list, '$list');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_stdClass_returns_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = (object)[
            11,
            12,
            13,
            14
        ];
        $this->assertInstanceOf(stdClass::class, $list);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsList::check($list, '$list');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_Traversable_returns_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = new ArrayObject([
            11,
            12,
            13,
            14
        ]);
        $this->assertInstanceOf(Traversable::class, $list);

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsList::check($list, '$list');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_arbitrary_objects_return_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = new IsList_ObjectTarget;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsList::check($list, '$list');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_Closure_returns_false()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = function() {};

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsList::check($list, '$list');

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     * @dataProvider provideNonLists
     *
     * @param mixed $list
     *        the non-list that we're going to use
     */
    public function test_anything_else_returns_false($list)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsList::check($list, '$list');

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

        $unit = new IsList;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(Check::class, $unit);
    }

    /**
     * @covers ::inspect
     */
    public function test_can_be_used_as_Check()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new IsList;

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

        $unit = new IsList;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(ListCheck::class, $unit);
    }

    /**
     * @covers ::checkList
     * @covers ::inspectList
     */
    public function test_can_be_used_as_ListCheck()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult1 = IsList::checkList([
            [ 1 ],
            [ 2 ]
        ]);
        $actualResult2 = IsList::checkList([
            1,
            2
        ]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult1);
        $this->assertFalse($actualResult2);
    }

    /**
     * a list of values that should fail the IsList check
     *
     * @return array
     */
    public function provideNonLists()
    {
        return [
            [ null ],
            [ true ],
            [ false ],
            [ 0.0 ],
            [ 3.1415927 ],
            [ -100.19 ],
            [ 0 ],
            [ -100 ],
            [ 100 ],
            [ STDIN ],
            [ "hello, world!" ],
        ];
    }
}

/**
 * helper class for proving that IsList will iterate over arbitrary objects
 */
class IsList_ObjectTarget
{
    /**
     * token public attribute
     *
     * @var string
     */
    public $alfred = "the butler";
}
