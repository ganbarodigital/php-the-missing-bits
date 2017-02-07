<?php

/**
 * Copyright (c) 2015-present Ganbaro Digital Ltd
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
 * @package   MissingBits/Types
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\TypeInspectors;

use ArrayObject;
use GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\GetArrayTypes
 */
class GetArrayTypesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new GetArrayTypes();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof GetArrayTypes);
    }

    /**
     * @covers ::getArrayTypes
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new GetArrayTypes();

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = $unit->getArrayTypes($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetArrayTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers \get_array_types
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = get_array_types($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    /**
     * @covers ::from
     */
    public function testDetectsCallableArrays()
    {
        // ----------------------------------------------------------------
        // setup your test

        $data = [ GetArrayTypes::class, 'from' ];
        $expectedResult = [
            'callable' => 'callable',
            'array' => 'array',
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = GetArrayTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @dataProvider provideNonArraysToTest
     */
    public function testRejectsNonArrays($data, $expectedTypes)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualTypes = GetArrayTypes::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedTypes, $actualTypes);
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideArraysToTest(),
            $this->provideNonArraysToTest()
        );
    }

    public function provideArraysToTest()
    {
        return [
            [ [ 1,2,3 ], [ 'array' => 'array' ] ],
            [ [ GetArrayTypes::class, 'from'], [ 'callable' => 'callable', 'array' => 'array' ] ],
        ];
    }

    public function provideNonArraysToTest()
    {
        return [
            [ null,  [] ],
            [ true, [] ],
            [ false, [] ],
            [ 0.0, [] ],
            [ 0, [] ],
            [ 1, [] ],
            [ new ArrayObject(), [] ],
            [ new GetArrayTypes(), [] ],
            [ (object)[ 'name' => 'test data'], [] ],
            [ '100', [] ],
            [ ArrayObject::class, [] ],
        ];
    }

}
