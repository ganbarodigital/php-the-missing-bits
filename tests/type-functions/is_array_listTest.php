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

class is_array_listTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::is_array_list
     */
    public function test_array_of_arrays_returns_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        $list = [
            [11],
            [12],
            [13],
            [14]
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = is_array_list($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::is_array_list
     * @dataProvider provideListsOfNonArrays
     *
     * @param mixed $list
     *        the list that we're going to use
     */
    public function test_lists_containing_anything_else_returns_false($list)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = is_array_list($list);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::is_array_list
     * @dataProvider provideNonLists
     */
    public function test_throws_InvalidArgumentException_if_passed_non_list($list, $expectedType)
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedMessage = '$list is not a list, is a ' . $expectedType;
        $actualMessage = null;

        // ----------------------------------------------------------------
        // perform the change

        try {
            is_array_list($list);
        }
        catch (InvalidArgumentException $e) {
            $actualMessage = $e->getMessage();
        }

        // ----------------------------------------------------------------
        // test the results

        // this will only pass:
        //
        // 1 - if an exception was thrown at all, and
        // 2 - if the exception contained the correct message
        //
        // this helps us catch cases where the right exception is being
        // thrown for other reasons
        $this->assertEquals($expectedMessage, $actualMessage);
    }

    /**
     * a list of values that should fail the is_array_list check
     *
     * @return array
     */
    public function provideListsOfNonArrays()
    {
        return [
            [ [null] ],
            [ [true] ],
            [ [false] ],
            [ [0.0] ],
            [ [3.1415927] ],
            [ [-100.19] ],
            [ [0] ],
            [ [-100] ],
            [ [100] ],
            [ [STDIN] ],
            [ ["hello, world!"] ],
        ];
    }

    public function provideNonLists()
    {
        return [
            [ null, 'NULL' ],
            [ true, 'boolean<true>' ],
            [ false, 'boolean<false>' ],
            [ 0.0, 'double<0>' ],
            [ 3.1415927, 'double<3.1415927>' ],
            [ -100.19, 'double<-100.19>' ],
            [ 0, 'integer<0>' ],
            [ -100, 'integer<-100>' ],
            [ 100, 'integer<100>' ],
            [ STDIN, 'resource' ],
            [ 'hello, world!', 'string<hello, world!>']
        ];
    }
}
