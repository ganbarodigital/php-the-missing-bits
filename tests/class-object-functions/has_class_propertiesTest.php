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
 * @package   MissingBits/ClassObjectFunctoins
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

class has_class_propertiesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::has_class_properties
     */
    public function test_returns_false_if_class_has_no_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = has_class_properties(has_class_propertiesTest_NoStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($actualResult);
    }

    /**
     * @covers ::has_class_properties
     */
    public function test_returns_true_if_class_has_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = has_class_properties('has_class_propertiesTest_SeveralStaticProperties');

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::has_class_properties
     */
    public function test_returns_true_if_parent_class_has_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = has_class_properties(has_class_propertiesTest_ChildOfStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::has_class_properties
     */
    public function test_returns_true_if_class_uses_traits_that_have_static_properties()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $actualResult = has_class_properties(has_class_propertiesTest_UsesTraitWithStaticProperties::class);

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($actualResult);
    }

    /**
     * @covers ::has_class_properties
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
            has_class_properties($target);
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
     * @covers ::has_class_properties
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
            has_class_properties($invalidClassname);
        }
        catch (InvalidArgumentException $e) {
            $actualMessage = $e->getMessage();
        }

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedMessage, $actualMessage);
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
            [ new has_class_propertiesTest_Stringy(), 'doesNotExist' ],
        ];
    }
}

class has_class_propertiesTest_NoStaticProperties
{
    public $objProp1 = 1;
}

class has_class_propertiesTest_SeveralStaticProperties
{
    public static $staticProp1 = 1;
    public static $staticProp2 = 2;
    public static $staticProp3 = 3;
    public static $staticProp4;

    public $objProp1 = 1;
}

class has_class_propertiesTest_ChildOfStaticProperties extends has_class_propertiesTest_SeveralStaticProperties
{

}

trait has_class_propertiesTest_TraitWithStaticProperty
{
    public static $staticTraitProp1 = 1;
}

trait has_class_propertiesTest_ChildTraitOfStaticProperties
{
    use has_class_propertiesTest_TraitWithStaticProperty;
}

class has_class_propertiesTest_UsesTraitWithStaticProperties
{
    use has_class_propertiesTest_ChildTraitOfStaticProperties;
}

class has_class_propertiesTest_ChildOfStaticsWithStaticTraits extends has_class_propertiesTest_SeveralStaticProperties
{
    use has_class_propertiesTest_ChildTraitOfStaticProperties;
}

class has_class_propertiesTest_Stringy
{
    public function __toString()
    {
        return 'doesNotExist';
    }
}
