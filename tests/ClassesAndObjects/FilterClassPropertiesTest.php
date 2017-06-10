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
 * @package   MissingBits/ClassesAndObjects
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\ClassesAndObjects;

use GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties;
use InvalidArgumentException;
use stdClass;
use TypeError;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\ClassesAndObjects\FilterClassProperties
 */
class FilterClassPropertiesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::from
     */
    public function test_returns_empty_array_if_class_has_no_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterClassProperties::from(FilterClassPropertiesTest_NoStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue(is_array($actualResult));
        $this->assertEquals(0, count($actualResult));
    }

    /**
     * @covers ::from
     */
    public function test_returns_list_of_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticProp1' => 1,
            'staticProp2' => 2,
            'staticProp3' => 3,
            'staticProp4' => null,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterClassProperties::from(FilterClassPropertiesTest_SeveralStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returned_list_includes_parent_classes_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticProp1' => 1,
            'staticProp2' => 2,
            'staticProp3' => 3,
            'staticProp4' => 4,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterClassProperties::from(FilterClassPropertiesTest_ChildOfStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returned_list_includes_traits_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticTraitProp1' => 1,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterClassProperties::from(FilterClassPropertiesTest_UsesTraitWithStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returned_list_includes_parent_classes_and_traits_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticProp1' => FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits::$staticProp1,
            'staticProp2' => FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits::$staticProp2,
            'staticProp3' => FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits::$staticProp3,
            'staticProp4' => FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits::$staticProp4,
            'staticTraitProp1' => FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits::$staticTraitProp1,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterClassProperties::from(FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @dataProvider provideNonStrings
     */
    public function test_throws_TypeError_for_non_strings($target, $expectedType)
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedMessage = '$target is not a string, is a ' . $expectedType;
        $actualMessage = null;

        // ----------------------------------------------------------------
        // perform the change

        try {
            FilterClassProperties::from($target);
        }
        catch (TypeError $e) {
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
     * @covers ::from
     * @dataProvider provideNonClassStrings
     */
    public function test_throws_InvalidArgumentException_if_target_is_not_valid_classname($invalidClassname, $classAsString)
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedMessage = "class/interface '" . $classAsString . "' not found";
        $actualMessage = null;

        // ----------------------------------------------------------------
        // perform the change

        try {
            FilterClassProperties::from($invalidClassname);
        }
        catch (InvalidArgumentException $e) {
            $actualMessage = $e->getMessage();
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedMessage, $actualMessage);
    }

    /**
     * @covers ::__construct
     */
    public function test_can_instantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $unit = new FilterClassProperties;

        // ----------------------------------------------------------------
        // test the results

        $this->assertInstanceOf(FilterClassProperties::class, $unit);
    }


    public function provideNonStrings()
    {
        return [
            [ null, 'NULL' ],
            [ [], 'array' ],
            [ true, 'boolean<true>' ],
            [ false, 'boolean<false>' ],
            [ function() {}, 'callable' ],
            [ new stdClass, 'object<stdClass>' ],
            [ STDIN, 'resource' ],
        ];
    }

    public function provideNonClassStrings()
    {
        return [
            [ 0.0, '0' ],
            [ -100.0, '-100' ],
            [ 100.0, '100' ],
            [ 3.1415927, '3.1415927' ],
            [ 0, '0' ],
            [ -100, '-100' ],
            [ 100, '100' ],
            [ 'doesNotExist', 'doesNotExist'],
            [ new FilterClassPropertiesTest_Stringy(), 'doesNotExist' ],
        ];
    }
}

class FilterClassPropertiesTest_NoStaticProperties
{
    public $objProp1 = 1;
}

class FilterClassPropertiesTest_SeveralStaticProperties
{
    public static $staticProp1 = 1;
    public static $staticProp2 = 2;
    public static $staticProp3 = 3;
    public static $staticProp4;

    public $objProp1 = 1;
}

class FilterClassPropertiesTest_ChildOfStaticProperties extends FilterClassPropertiesTest_SeveralStaticProperties
{
    public static $staticProp4 = 4;
}

trait FilterClassPropertiesTest_Trait1WithStaticProperty
{
    public static $staticTraitProp1 = 1;
}

trait FilterClassPropertiesTest_Trait2WithStaticProperty
{
    public static $staticTraitProp1 = 2;
}

trait FilterClassPropertiesTest_ChildTraitOfStaticProperties
{
    use FilterClassPropertiesTest_Trait1WithStaticProperty;
}

class FilterClassPropertiesTest_UsesTraitWithStaticProperties
{
    use FilterClassPropertiesTest_ChildTraitOfStaticProperties;
}

class FilterClassPropertiesTest_ParentWithStaticTraits extends FilterClassPropertiesTest_SeveralStaticProperties
{
    use FilterClassPropertiesTest_Trait2WithStaticProperty;
}

class FilterClassPropertiesTest_ChildOfStaticsWithStaticTraits extends FilterClassPropertiesTest_ParentWithStaticTraits
{
    use FilterClassPropertiesTest_Trait2WithStaticProperty;
}

class FilterClassPropertiesTest_Stringy
{
    public function __toString()
    {
        return 'doesNotExist';
    }
}
