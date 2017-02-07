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

class VnsprintfTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::vnsprintf
     * @dataProvider providePhpManualExamples
     */
    public function testSupportsSprintfStrings($format, $data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = vnsprintf($format, $data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::vnsprintf
     */
    public function testSupportsNamedParameters()
    {
        // ----------------------------------------------------------------
        // setup your test

        $args = [
            'animal' => 'cat',
            'place' => 'the mat'
        ];
        $format = "The %animal\$s sat on %place\$s";

        $expectedResult = "The cat sat on the mat";

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = vnsprintf($format, $args);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::vnsprintf
     */
    public function testSupportsNamedAndPositionalParameters()
    {
        // ----------------------------------------------------------------
        // setup your test

        $args = [
            'sat',
            'animal' => 'cat',
            'place' => 'the mat'
        ];
        $format = "The %animal\$s %1\$s on %place\$s";

        $expectedResult = "The cat sat on the mat";

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = vnsprintf($format, $args);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::vnsprintf
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionWhenNamedParameterNotInArgs()
    {
        // ----------------------------------------------------------------
        // setup your test

        $args = [
            'place' => 'the mat'
        ];
        $format = "The %animal\$s sat on %place\$s";

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = vnsprintf($format, $args);

        // ----------------------------------------------------------------
        // test the results

    }

    /**
     * these example format strings have been taken from the PHP manual page
     * for sprintf(), and (where necessary) updated for 64-bit architectures
     *
     * @return array
     */
    public function providePhpManualExamples()
    {
        $n =  43951789;
        $u = -43951789;
        $c = 65; // ASCII 65 is 'A'

        $s = 'monkey';
        $t = 'many monkeys';

        return [
            [ "%%b = '%b'", [ $n ], "%b = '10100111101010011010101101'" ],
            [ "%%c = '%c'", [ $c ], "%c = 'A'" ],
            [ "%%d = '%d'", [ $n ], "%d = '43951789'" ],
            [ "%%e = '%e'", [ $n ], "%e = '4.395179e+7'" ],
            [ "%%u = '%u'", [ $n ], "%u = '43951789'" ],
            [ "%%u = '%u'", [ $u ], "%u = '18446744073665599827'" ],
            [ "%%f = '%f'", [ $n ], "%f = '43951789.000000'" ],
            [ "%%o = '%o'", [ $n ], "%o = '247523255'" ],
            [ "%%s = '%s'", [ $n ], "%s = '43951789'" ],
            [ "%%x = '%x'", [ $n ], "%x = '29ea6ad'" ],
            [ "%%X = '%X'", [ $n ], "%X = '29EA6AD'" ],
            [ "%%+d = '%+d'", [ $n ], "%+d = '+43951789'" ],
            [ "%%+d = '%+d'", [ $u ], "%+d = '-43951789'" ],
            [ "[%s]", [ $s ], "[monkey]" ],
            [ "[%10s]", [ $s ], "[    monkey]" ],
            [ "[%-10s]", [ $s ], "[monkey    ]" ],
            [ "[%010s]", [ $s ], "[0000monkey]" ],
            [ "[%'#10s]", [ $s ], "[####monkey]" ],
            [ "[%10.10s]", [ $t ], "[many monke]" ],
            [ "%04d-%02d-%02d", [ 2016, 4, 1 ], "2016-04-01" ],
            [ "%01.2f", [ 123.1 ], "123.10" ],
            [ 'The %2$s contains %1$d monkeys', [ 5, 'tree' ], "The tree contains 5 monkeys" ],
        ];
    }
}
