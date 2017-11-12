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
 * @package   MissingBits/ConsoleOutput
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\ConsoleOutput;

use GanbaroDigital\MissingBits\ConsoleOutput\ShowProgress;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\ConsoleOutput\ShowProgress
 */
class ShowProgressTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::with
     */
    public function test_prints_single_dot_per_call()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = '.';

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = ShowProgress::with(".", 1, 80, 80, 'sprintf');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue(is_string($actualResult));
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::with
     * @covers ::addProgressCount
     */
    public function test_prints_progress_at_end_of_line()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = "................................................................ [ 64 / 160]" . PHP_EOL;
        $actualResult = "";

        // ----------------------------------------------------------------
        // perform the change
        //
        // we build the result up bit by bit, to mimic actual behaviour
        // in the wild

        for($i = 1 ; $i <= 64 ; $i++)
        {
            $actualResult .= ShowProgress::with(".", $i, 160, 80, 'sprintf');
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::with
     * @covers ::addProgressCount
     */
    public function test_prints_progress_when_max_progress_reached()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = "................................................................ [ 64 / 160]" . PHP_EOL
                        . "................................................................ [128 / 160]" . PHP_EOL
                        . "................................                                 [160 / 160]" . PHP_EOL;
        $actualResult = "";

        // ----------------------------------------------------------------
        // perform the change
        //
        // we build the result up bit by bit, to mimic actual behaviour
        // in the wild

        for($i = 1 ; $i <= 160 ; $i++)
        {
            $actualResult .= ShowProgress::with(".", $i, 160, 80, 'sprintf');
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

}