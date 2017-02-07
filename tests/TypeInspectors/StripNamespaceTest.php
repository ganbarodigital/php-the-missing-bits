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

use Traversable;
use ArrayObject;
use GanbaroDigital\MissingBits\TypeInspectors\StripNamespace;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\TypeInspectors\StripNamespace
 */
class StripNamespaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @coversNone
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // perform the change

        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit instanceof StripNamespace);
    }

    /**
     * @covers ::stripNamespace
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanUseAsObject($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->stripNamespace($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallStatically($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = StripNamespace::from($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers \strip_namespace
     * @covers ::from
     * @dataProvider provideDataToTest
     */
    public function testCanCallAsFunction($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = strip_namespace($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::stripNamespace
     * @covers ::from
     * @dataProvider provideClassesWithNamespacesToTest
     */
    public function testStripsNamespacesFromClasses($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_string($data));
        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->stripNamespace($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::stripNamespace
     * @covers ::from
     * @dataProvider provideObjectsToTest
     */
    public function testStripsNamespacesFromObjects($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_object($data));
        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->stripNamespace($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::stripNamespace
     * @covers ::from
     * @dataProvider provideClassesWithoutNamespacesToTest
     */
    public function testReturnsClassNameForClassesWithNoNamespace($data, $expectedResult)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_string($data));
        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = $unit->stripNamespace($data);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::stripNamespace
     * @covers ::from
     * @dataProvider provideNonDefinedClassesToTest
     * @expectedException InvalidArgumentException
     */
    public function test_throws_InvalidArgumentException_if_class_not_defined($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(is_string($data));
        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // perform the change

        $unit->stripNamespace($data);

        // ----------------------------------------------------------------
        // test the results

    }

    /**
     * @covers ::stripNamespace
     * @covers ::from
     * @dataProvider provideEverythingElseToTest
     * @expectedException InvalidArgumentException
     */
    public function test_throws_InvalidArgumentException_for_everything_else($data)
    {
        // ----------------------------------------------------------------
        // setup your test

        $this->assertTrue(!is_string($data) && !is_object($data));
        $unit = new StripNamespace();

        // ----------------------------------------------------------------
        // perform the change

        $unit->stripNamespace($data);

        // ----------------------------------------------------------------
        // test the results
    }

    public function provideDataToTest()
    {
        return array_merge(
            $this->provideClassesWithNamespacesToTest(),
            $this->provideClassesWithoutNamespacesToTest(),
            $this->provideObjectsToTest()
        );
    }

    public function provideClassesWithNamespacesToTest()
    {
        return [
            [ StripNamespace::class, 'StripNamespace' ],
        ];
    }

    public function provideClassesWithoutNamespacesToTest()
    {
        return [
            [ ArrayObject::class, 'ArrayObject' ],
            [ Traversable::class, 'Traversable' ],
        ];
    }

    public function provideObjectsToTest()
    {
        return [
            [ (object)[ 'name' => 'test data'], 'stdClass' ],
            [ new StripNamespace, 'StripNamespace' ],
        ];
    }

    public function provideNonDefinedClassesToTest()
    {
        return [
            [ 'StuffAndNonsense' ],
        ];
    }

    public function provideEverythingElseToTest()
    {
        return [
            [ null ],
            [ [ 1,2,3 ] ],
            [ [ GetNumericType::class, 'from'] ],
            [ true ],
            [ false ],
            [ STDIN ],
        ];
    }
}
