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
 * @package   MissingBits/StringFunctions
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

class check_is_stringyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_TRUE_for_strings()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = "hello, world";
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_TRUE_for_integers()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = 100;
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_TRUE_for_doubles()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = 3.1415927;
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_TRUE_for_objects_that_implement_toString()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = new IsStringy_ObjectWithToString();
        $expectedResult = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_objects_that_do_not_implement_toString()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = new stdClass;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_NULL()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = null;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_arrays()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = [];
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_TRUE()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = true;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_FALSE()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = false;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_callable_arrays()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = [ __CLASS__, __FUNCTION__ ];
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::check_is_stringy
     */
    public function test_returns_FALSE_for_resources()
    {
        // ----------------------------------------------------------------
        // setup your test

        $item = STDIN;
        $expectedResult = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = check_is_stringy($item);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

}

class IsStringy_ObjectWithToString
{
    public function __toString()
    {
        return get_class($this);
    }
}
