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
 * @package   MissingBits/ListChecks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

class check_is_listy_objectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::check_is_listy_object
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

        $actualResult = check_is_listy_object($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check_is_listy_object
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

        $actualResult = check_is_listy_object($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check_is_listy_object
     */
    public function test_arbitrary_objects_return_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = new check_is_listy_object_ObjectTarget;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_listy_object($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check_is_listy_object
     */
    public function test_Closure_returns_false()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into IsList()
        $list = function() {};

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_listy_object($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check_is_listy_object
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

        $actualResult = check_is_listy_object($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
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
            [ 1, 2, 3, 4 ],
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
class check_is_listy_object_ObjectTarget
{
    /**
     * token public attribute
     *
     * @var string
     */
    public $alfred = "the butler";
}
