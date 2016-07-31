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
 * @package   MissingBits/ListTraversals
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\ListTraversals;

use GanbaroDigital\MissingBits\ListTraversals\TraverseList;
use PHPUnit_Framework_TestCase;
use ArrayObject;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\ListTraversals\TraverseList
 */
class TraverseListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::using
     */
    public function test_will_traverse_array()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = [
            11,
            12,
            13,
            14
        ];

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list[0]' => 11,
            '$list[1]' => 12,
            '$list[2]' => 13,
            '$list[3]' => 14,
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     */
    public function test_will_treat_Traversable_as_array()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = new ArrayObject([
            11,
            12,
            13,
            14
        ]);

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list[0]' => 11,
            '$list[1]' => 12,
            '$list[2]' => 13,
            '$list[3]' => 14,
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     */
    public function test_array_numeric_keys_are_passed_to_callable()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = [
            100 => 11,
            101 => 12,
            214 => 13,
            999 => 14
        ];

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list[100]' => 11,
            '$list[101]' => 12,
            '$list[214]' => 13,
            '$list[999]' => 14,
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     */
    public function test_array_string_keys_are_passed_to_callable()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = [
            'fish' => 'trout',
            'harry' => 'sally',
        ];

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list[\'fish\']' => 'trout',
            '$list[\'harry\']' => 'sally',
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     */
    public function test_will_traverse_object()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = (object)[
            11,
            12,
            13,
            14
        ];

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list->{0}' => 11,
            '$list->{1}' => 12,
            '$list->{2}' => 13,
            '$list->{3}' => 14,
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     */
    public function test_object_numeric_property_names_are_passed_to_callable()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = (object)[
            100 => 11,
            101 => 12,
            214 => 13,
            999 => 14
        ];

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list->{100}' => 11,
            '$list->{101}' => 12,
            '$list->{214}' => 13,
            '$list->{999}' => 14,
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     */
    public function test_object_string_property_names_are_passed_to_callable()
    {
        // ----------------------------------------------------------------
        // setup your test

        // this is what we're going to feed into TraverseList
        $list = (object)[
            'fish' => 'trout',
            'harry' => 'sally',
        ];

        // our callable is going to build a list of what it receives
        // the list should look like this
        $expectedList = [
            '$list->fish' => 'trout',
            '$list->harry' => 'sally',
        ];

        // this will hold the list built by our callable
        $actualList = [];

        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results

        $this->assertEquals($expectedList, $actualList);
    }

    /**
     * @covers ::using
     * @dataProvider provideNonLists
     * @expectedException InvalidArgumentException
     */
    public function test_throws_InvalidArgumentException_when_list_is_not_an_arry_or_object($list)
    {
        // ----------------------------------------------------------------
        // setup your test

        // this will hold the list built by our callable
        $actualList = [];

        // the test uses a valid callable just to make sure this
        // is not triggering any exceptions of any kind
        $callable = function($value, $key, $name) use (&$actualList) {
            $actualList[$name] = $value;
        };

        // ----------------------------------------------------------------
        // perform the change

        TraverseList::using($list, '$list', $callable);

        // ----------------------------------------------------------------
        // test the results
    }

    public function provideNonLists()
    {
        return [
            [ null ],
            [ true ],
            [ false ],
            [ 0.0 ],
            [ 3.1415927 ],
            [ -100.19 ],
            [ 0 ],
            [ -100 ],
            [ 100 ],
            [ STDIN ],
            [ "hello, world!" ],
        ];
    }
}
