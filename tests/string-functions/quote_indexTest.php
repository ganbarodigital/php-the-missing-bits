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

class quote_indexTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::quote_index
     * @dataProvider provideStrings
     */
    public function test_adds_quotes_to_strings($name, $expectedName)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($name);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_adds_quotes_objects_that_have_toString()
    {
        // ----------------------------------------------------------------
        // setup your test

        $name = new QuoteIndex_String("extractArray");
        $expectedName = "extractArray";

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($name);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_returns_objects_that_do_not_have_toString_unchanged()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedName = new stdClass;

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($expectedName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_throws_InvalidArgumentException_for_NULL()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedName = null;

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($expectedName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_throws_InvalidArgumentException_for_true()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedName = true;

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($expectedName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_throws_InvalidArgumentException_for_false()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedName = false;

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($expectedName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_throws_InvalidArgumentException_for_arrays()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedName = [];

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($expectedName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    /**
     * @covers ::quote_index
     */
    public function test_throws_InvalidArgumentException_for_resources()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedName = STDIN;

        // ----------------------------------------------------------------
        // perform the change

        $actualName = quote_index($expectedName);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedName, $actualName);
    }

    public function provideStrings()
    {
        return [
            [ "extractArray", "'extractArray'" ],
            [ "ExtractArray", "'ExtractArray'" ],
            [ "_extractArray", "'_extractArray'" ],
            [ "_ExtractArray", "'_ExtractArray'" ],
            [ "extract_array", "'extract_array'" ],
            [ "Extract_Array", "'Extract_Array'" ],
            [ "_extract_array", "'_extract_array'" ],
            [ "_Extract_Array", "'_Extract_Array'" ],
            [ "_00_extract_array", "'_00_extract_array'" ],
            [ "extract-array", "'extract-array'" ],
        ];
    }
}

class QuoteIndex_String
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
