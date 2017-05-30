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
 * @package   MissingBits/ArrayFunctions
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

class array_append_valuesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::array_append_values
     * @dataProvider provideArraysToAppend
     */
    public function test_can_append_to_array($target, $extra, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = array_append_values($target, $extra);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::array_append_values
     * @dataProvider provideArraysToAppend
     */
    public function test_original_array_is_unmodified($target, $extra, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // we expect $target to remain unchanged
        $expectedResult = $target;

        // ----------------------------------------------------------------
        // perform the change

        array_append_values($target, $extra);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $target);
    }

    public function provideArraysToAppend()
    {
        return [
            [
                [ 1,2,3],
                [ 4,5,6],
                [ 1,2,3,4,5,6]
            ],
            [
                ['color' => 'red', 2, 4],
                ['a', 'b', 'color' => 'green', 'shape' => 'trapezoid', 4],
                ['color' => 'red', 2, 4, 'a', 'b', 'green', 'trapezoid', 4]
            ],
        ];
    }
}
