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

namespace GanbaroDigital\MissingBits\TypeChecks;

use stdClass;
use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigitalTest\MissingBits\DataProviders;
use TypeError;

// the data providers for our tests
require_once(__DIR__ . '/../_datasets/callables.php');
require_once(__DIR__ . '/../_datasets/lists.php');

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeChecks\IsListOfCallables
 */
class IsListOfCallablesTest extends \PHPUnit\Framework\TestCase
{
    use DataProviders\CallableDataProviders;
    use DataProviders\ListDataProviders;

    /**
     * @coversNothing
     */
    public function test_can_instantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new IsListOfCallables();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof IsListOfCallables);
    }

    /**
     * @covers ::using
     */
    public function test_supports_fluent_interface()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = IsListOfCallables::using();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof IsListOfCallables);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideNonLists
     */
    public function test_throws_TypeError_for_non_lists($nonList)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $caughtException = false;
        try {
            IsListOfCallables::check($nonList);
        }
        catch (TypeError $e) {
            $caughtException = true;
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($caughtException);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideCallableArrays
     */
    public function test_returns_TRUE_for_callable_arrays($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfCallables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideCallableFunctions
     */
    public function test_returns_TRUE_for_callable_functions($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfCallables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideCallableObjects
     */
    public function test_returns_TRUE_for_callable_objects($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfCallables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideCallableStrings
     */
    public function test_returns_TRUE_for_callable_strings($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfCallables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     * @covers ::inspect
     * @dataProvider provideNonCallables
     */
    public function test_returns_FALSE_for_everything_else($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = IsListOfCallables::check([$data]);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }
}