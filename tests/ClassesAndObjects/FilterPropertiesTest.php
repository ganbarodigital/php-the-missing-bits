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

use GanbaroDigital\MissingBits\ClassesAndObjects\FilterProperties;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\ClassesAndObjects\FilterProperties
 */
class FilterPropertiesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::from
     */
    public function test_returns_static_properties_from_classes()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticProp1' => FilterPropertiesTest_Target::$staticProp1,
            'staticProp2' => FilterPropertiesTest_Target::$staticProp2
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(FilterPropertiesTest_Target::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_static_properties_from_parent_classes()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticProp1' => FilterPropertiesTest_ChildWithNoProperties::$staticProp1,
            'staticProp2' => FilterPropertiesTest_ChildWithNoProperties::$staticProp2,
            'staticProp3' => FilterPropertiesTest_ChildWithNoProperties::$staticProp3,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(FilterPropertiesTest_ChildWithNoProperties::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_static_properties_from_trait_used_by_class()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticTraitProp1' => FilterPropertiesTest_TraitTarget::$staticTraitProp1,
            'staticTraitProp2' => FilterPropertiesTest_TraitTarget::$staticTraitProp2,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(FilterPropertiesTest_TraitTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_static_properties_from_trait_used_by_parent_class()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticTraitProp1' => FilterPropertiesTest_ChildTraitTarget::$staticTraitProp1,
            'staticTraitProp2' => FilterPropertiesTest_ChildTraitTarget::$staticTraitProp2,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(FilterPropertiesTest_ChildTraitTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_static_properties_from_trait_used_by_class_and_parent_class()
    {
        // ----------------------------------------------------------------
        // setup your test

        $expectedResult = [
            'staticTraitProp1' => FilterPropertiesTest_ChildWithTraitTarget::$staticTraitProp1,
            'staticTraitProp2' => FilterPropertiesTest_ChildWithTraitTarget::$staticTraitProp2,
            'staticTraitProp3' => FilterPropertiesTest_ChildWithTraitTarget::$staticTraitProp3,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(FilterPropertiesTest_ChildWithTraitTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_non_static_properties_from_objects()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterPropertiesTest_Target;
        $expectedResult = [
            'objProp1' => $target->objProp1,
            'objProp2' => $target->objProp2
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = $this->getObjectPropFilter($target);
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_non_static_properties_from_parent_classes()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterPropertiesTest_ChildTarget;
        $target->objProp1 = 999;
        $expectedResult = [
            'objProp1' => $target->objProp1,
            'objProp2' => $target->objProp2,
            'objProp3' => $target->objProp3,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = $this->getObjectPropFilter($target);
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_non_static_properties_from_trait_used_by_object()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterPropertiesTest_TraitTarget;
        $expectedResult = [
            'traitProp1' => $target->traitProp1,
            'traitProp2' => $target->traitProp2,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = $this->getObjectPropFilter($target);
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_non_static_properties_from_trait_used_by_parent_class()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterPropertiesTest_ChildTraitTarget;
        $expectedResult = [
            'traitProp1' => $target->traitProp1,
            'traitProp2' => $target->traitProp2,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = $this->getObjectPropFilter($target);
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @covers ::from
     */
    public function test_returns_non_static_properties_from_trait_used_by_object_and_parent_class()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new FilterPropertiesTest_ChildWithTraitTarget;
        $expectedResult = [
            'traitProp1' => $target->traitProp1,
            'traitProp2' => $target->traitProp2,
            'traitProp3' => $target->traitProp3,
        ];

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = $this->getObjectPropFilter($target);
        $actualResult = FilterProperties::from($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function classPropFilter($refProp, &$knownProperties) {
        if (!$refProp->isStatic()) {
            return;
        }

        if (isset($knownProperties[$refProp->getName()])) {
            return;
        }

        $refProp->setAccessible(true);
        $knownProperties[$refProp->getName()] = $refProp->getValue();
    }

    public function getObjectPropFilter($target)
    {
        return function($refProp, &$knownProperties) use($target) {
            if ($refProp->isStatic()) {
                return;
            }

            if (isset($knownProperties[$refProp->getName()])) {
                return;
            }

            $refProp->setAccessible(true);
            $knownProperties[$refProp->getName()] = $refProp->getValue($target);
        };
    }
}

class FilterPropertiesTest_Target
{
    public static $staticProp1 = 1;
    public static $staticProp2 = 2;

    public $objProp1 = 101;
    public $objProp2 = 102;
}

class FilterPropertiesTest_ChildTarget extends FilterPropertiesTest_Target
{
    public static $staticProp2 = 3;
    public static $staticProp3 = 4;

    public $objProp2 = 103;
    public $objProp3 = 104;
}

class FilterPropertiesTest_ChildWithNoProperties extends FilterPropertiesTest_ChildTarget
{

}

trait FilterPropertiesTest_Trait
{
    public static $staticTraitProp1 = 1;
    public static $staticTraitProp2 = 2;

    public $traitProp1 = 101;
    public $traitProp2 = 102;
}

class FilterPropertiesTest_TraitTarget
{
    use FilterPropertiesTest_Trait;
}

class FilterPropertiesTest_ChildTraitTarget extends FilterPropertiesTest_TraitTarget
{
}

trait FilterPropertiesTest_Trait2
{
    public static $staticTraitProp1 = 1;
    public static $staticTraitProp2 = 2;
    public static $staticTraitProp3 = 3;

    public $traitProp1 = 101;
    public $traitProp2 = 102;
    public $traitProp3 = 103;
}

class FilterPropertiesTest_ChildWithTraitTarget extends FilterPropertiesTest_ChildTraitTarget
{
    use FilterPropertiesTest_Trait2;
}
