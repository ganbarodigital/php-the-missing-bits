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

use GanbaroDigital\MissingBits\ClassesAndObjects\HasFilteredProperties;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use stdClass;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\ClassesAndObjects\HasFilteredProperties
 */
class HasFilteredPropertiesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::check
     */
    public function test_returns_false_when_class_has_no_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(HasFilteredPropertiesTest_EmptyTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_class_has_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(HasFilteredPropertiesTest_Target::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_parent_classes_have_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(HasFilteredPropertiesTest_ChildTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_class_uses_trait_with_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(HasFilteredPropertiesTest_TraitTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_parent_class_uses_trait_with_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionClass(HasFilteredPropertiesTest_ChildTraitTarget::class);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'classPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_false_when_object_has_no_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new HasFilteredPropertiesTest_EmptyTarget;

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'objectPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_object_has_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new HasFilteredPropertiesTest_Target;

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'objectPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_parent_class_has_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new HasFilteredPropertiesTest_ChildTarget;

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'objectPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_object_uses_trait_with_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new HasFilteredPropertiesTest_TraitTarget;

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'objectPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::check
     */
    public function test_returns_true_when_object_parent_class_uses_trait_with_non_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        $target = new HasFilteredPropertiesTest_ChildTraitTarget;

        // ----------------------------------------------------------------
        // perform the change

        $refObj = new ReflectionObject($target);
        $propTypes = ReflectionProperty::IS_PUBLIC;
        $propFilter = [$this, 'objectPropFilter'];
        $actualResult = HasFilteredProperties::check($refObj, $propTypes, $propFilter);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    public function classPropFilter($refProp) {
        if ($refProp->isStatic()) {
            return true;
        }
        return false;
    }

    public function objectPropFilter($refProp)
    {
        if (!$refProp->isStatic()) {
            return true;
        }
        return false;
    }
}

class HasFilteredPropertiesTest_EmptyTarget
{

}

class HasFilteredPropertiesTest_Target
{
    public static $staticProp1 = 1;
    public static $staticProp2 = 2;

    public $objProp1 = 101;
    public $objProp2 = 102;
}

class HasFilteredPropertiesTest_ChildTarget extends HasFilteredPropertiesTest_Target
{
    public static $staticProp2 = 3;
    public static $staticProp3 = 4;

    public $objProp2 = 103;
    public $objProp3 = 104;
}

trait HasFilteredPropertiesTest_Trait
{
    public static $staticTraitProp1 = 1;
    public static $staticTraitProp2 = 2;

    public $traitProp1 = 101;
    public $traitProp2 = 102;
}

class HasFilteredPropertiesTest_TraitTarget
{
    use HasFilteredPropertiesTest_Trait;
}

class HasFilteredPropertiesTest_ChildTraitTarget extends HasFilteredPropertiesTest_TraitTarget
{
}

trait HasFilteredPropertiesTest_Trait2
{
    public static $staticTraitProp1 = 1;
    public static $staticTraitProp2 = 2;
    public static $staticTraitProp3 = 3;

    public $traitProp1 = 101;
    public $traitProp2 = 102;
    public $traitProp3 = 103;
}

trait HasFilteredPropertiesTest_Trait3
{
    use HasFilteredPropertiesTest_Trait2;
}

class HasFilteredPropertiesTest_ChildWithTraitTarget extends HasFilteredPropertiesTest_ChildTraitTarget
{
    use HasFilteredPropertiesTest_Trait3;
}
