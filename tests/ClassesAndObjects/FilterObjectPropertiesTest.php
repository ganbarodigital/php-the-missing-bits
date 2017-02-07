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

use GanbaroDigital\MissingBits\ClassesAndObjects\FilterObjectProperties;
use InvalidArgumentException;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\ClassesAndObjects\FilterObjectProperties
 */
class FilterObjectPropertiesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::from
     */
    public function test_returns_empty_array_if_object_has_no_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterObjectPropertiesTest_NoNonStaticProperties;

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterObjectProperties::from($target);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue(is_array($actualResult));
        $this->assertEquals(0, count($actualResult));
    }

    /**
     * @covers ::from
     */
    public function test_returns_list_of_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterObjectPropertiesTest_SeveralNonStaticProperties;

        $expectedResult = [
            'objProp1' => $target->objProp1,
            'objProp2' => $target->objProp2,
            'objProp3' => $target->objProp3,
            'objProp4' => $target->objProp4,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterObjectProperties::from($target);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returned_list_includes_parent_classes_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterObjectPropertiesTest_ChildOfNonStaticProperties;
        $target->objProp4 = 100;

        $expectedResult = [
            'objProp1' => $target->objProp1,
            'objProp2' => $target->objProp2,
            'objProp3' => $target->objProp3,
            'objProp4' => $target->objProp4,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterObjectProperties::from($target);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returned_list_includes_traits_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterObjectPropertiesTest_UsesTraitWithNonStaticProperties;

        $expectedResult = [
            'traitProp1' => $target->traitProp1,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterObjectProperties::from($target);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returned_list_includes_parent_classes_and_traits_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterObjectPropertiesTest_ChildOfNonStaticsWithNonStaticTraits;

        $expectedResult = [
            'objProp1' => $target->objProp1,
            'objProp2' => $target->objProp2,
            'objProp3' => $target->objProp3,
            'objProp4' => $target->objProp4,
            'traitProp1' => $target->traitProp1,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = FilterObjectProperties::from($target);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     * @dataProvider provideNonObjects
     */
    public function test_throws_InvalidArgumentException_for_non_objects($target, $expectedType)
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedMessage = '$target is not an object, is a ' . $expectedType;
        $actualMessage = null;

        // ----------------------------------------------------------------
        // perform the change

        try {
            FilterObjectProperties::from($target);
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

    public function provideNonObjects()
    {
        return [
            [ null, 'NULL' ],
            [ [], 'array' ],
            [ true, 'boolean<true>' ],
            [ false, 'boolean<false>' ],
            [ 0.0, 'double<0>' ],
            [ -100.0, 'double<-100>' ],
            [ 100.0, 'double<100>' ],
            [ 3.1415927, 'double<3.1415927>' ],
            [ 0, 'integer<0>' ],
            [ -100, 'integer<-100>' ],
            [ 100, 'integer<100>' ],
            [ STDIN, 'resource' ],
            [ 'doesNotExist', 'string<doesNotExist>'],
        ];
    }
}

class FilterObjectPropertiesTest_NoNonStaticProperties
{
    public static $staticProp1 = 1;
}

class FilterObjectPropertiesTest_SeveralNonStaticProperties
{
    public static $staticProp1 = 1;

    public $objProp1 = 1;
    public $objProp2 = 2;
    public $objProp3 = 3;
    public $objProp4;
}

class FilterObjectPropertiesTest_ChildOfNonStaticProperties extends FilterObjectPropertiesTest_SeveralNonStaticProperties
{
    public $objProp4 = 4;
}

trait FilterObjectPropertiesTest_Trait1WithNonStaticProperty
{
    public $traitProp1 = 1;
}

trait FilterObjectPropertiesTest_Trait2WithNonStaticProperty
{
    public $traitProp1 = 2;
}

trait FilterObjectPropertiesTest_ChildTraitOfNonStaticProperties
{
    use FilterObjectPropertiesTest_Trait1WithNonStaticProperty;
}

class FilterObjectPropertiesTest_UsesTraitWithNonStaticProperties
{
    use FilterObjectPropertiesTest_ChildTraitOfNonStaticProperties;
}

class FilterObjectPropertiesTest_ParentWithNonStaticTraits extends FilterObjectPropertiesTest_SeveralNonStaticProperties
{
    use FilterObjectPropertiesTest_Trait2WithNonStaticProperty;
}

class FilterObjectPropertiesTest_ChildOfNonStaticsWithNonStaticTraits extends FilterObjectPropertiesTest_ParentWithNonStaticTraits
{
    use FilterObjectPropertiesTest_Trait2WithNonStaticProperty;
}
