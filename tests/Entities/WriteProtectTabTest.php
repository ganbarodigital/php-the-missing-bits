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
 * @package   MissingBits/Entities
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigitalTest\MissingBits\Entities;

use GanbaroDigital\MissingBits\Entities\ReadOnlyException;
use GanbaroDigital\MissingBits\Entities\WriteProtectTab;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\MissingBits\Entities\WriteProtectTab
 */
class WriteProtectTabTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::isReadOnly
     * @covers ::isReadWrite
     */
    public function test_starts_in_read_write()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new WriteProtectTabTestClass;

        // ----------------------------------------------------------------
        // perform the change


        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit->isReadWrite());
        $this->assertFalse($unit->isReadOnly());
    }

    /**
     * @covers ::isReadOnly
     * @covers ::isReadWrite
     * @covers ::setReadOnly
     */
    public function test_can_write_protect()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new WriteProtectTabTestClass;

        // ----------------------------------------------------------------
        // perform the change

        $unit->setReadOnly();

        // ----------------------------------------------------------------
        // test the results

        $this->assertFalse($unit->isReadWrite());
        $this->assertTrue($unit->isReadOnly());
    }

    /**
     * @covers ::isReadOnly
     * @covers ::isReadWrite
     * @covers ::setReadOnly
     * @covers ::requireReadWrite
     *
     * @expectedException GanbaroDigital\MissingBits\Entities\ReadOnlyException
     */
    public function test_can_enforce_write_protection()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new WriteProtectTabTestClass;
        $unit->setReadOnly();
        $this->assertFalse($unit->isReadWrite());
        $this->assertTrue($unit->isReadOnly());

        // ----------------------------------------------------------------
        // perform the change

        $unit->checkRequirement();

        // ----------------------------------------------------------------
        // test the results

    }

    /**
     * @covers ::isReadOnly
     * @covers ::isReadWrite
     * @covers ::setReadWrite
     * @covers ::requireReadWrite
     */
    public function test_can_write_enable()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new WriteProtectTabTestClass;
        $unit->setReadOnly();
        $this->assertFalse($unit->isReadWrite());
        $this->assertTrue($unit->isReadOnly());

        // ----------------------------------------------------------------
        // perform the change

        $unit->setReadWrite();

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($unit->isReadWrite());
        $this->assertFalse($unit->isReadOnly());

        // this would trigger an exception if we were in read-only mode
        $unit->checkRequirement();
    }

    /**
     * @covers ::isReadOnly
     * @covers ::isReadWrite
     * @covers ::setReadOnly
     * @covers ::setReadWrite
     *
     * @expectedException GanbaroDigital\MissingBits\Entities\ReadOnlyForeverException
     */
    public function test_can_enforce_read_only_forever_protection()
    {
        // ----------------------------------------------------------------
        // setup your test

        $unit = new WriteProtectTabTestClass;
        $unit->setReadOnlyForever();
        $this->assertFalse($unit->isReadWrite());
        $this->assertTrue($unit->isReadOnly());

        // ----------------------------------------------------------------
        // perform the change

        $unit->setReadWrite();

        // ----------------------------------------------------------------
        // test the results

    }
}

/**
 * a little vehicle to help us test this trait without having to resort
 * to mocks
 */
class WriteProtectTabTestClass
{
    use WriteProtectTab;

    public function checkRequirement()
    {
        $this->requireReadWrite();
    }
}
