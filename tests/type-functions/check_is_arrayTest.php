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

class check_is_arrayTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::check_is_array
     */
    public function test_returns_TRUE_for_array()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = [];
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_array($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_array
     */
    public function test_returns_FALSE_for_IteratorAggregate()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new check_is_arrayTest_Target1;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_array($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_array
     */
    public function test_returns_FALSE_for_ArrayIterator()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new ArrayIterator([]);
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_array($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_array
     */
    public function test_returns_FALSE_for_ArrayObject()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new ArrayObject;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_array($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_array
     */
    public function test_returns_FALSE_for_stdClass()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = new stdClass;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_array($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_array
     * @dataProvider provideEverythingElse
     */
    public function test_returns_FALSE_for_everything_else($item)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_array($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
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
        ];
    }

}

// cribbed directly from the PHP manual
class check_is_arrayTest_Target1 implements IteratorAggregate
{
    public function getIterator()
    {
        return new ArrayIterator([]);
    }
}
