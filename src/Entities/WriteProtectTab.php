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

namespace GanbaroDigital\MissingBits\Entities;
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;

/**
 * very simple implementation of the WriteProtectableEntity interface
 */
trait WriteProtectTab
{
    private $readOnly = false;

    /**
     * can we edit this entity?
     *
     * @return boolean
     *         FALSE if we can edit this entity
     *         TRUE otherwise
     */
    public function isReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * can we edit this entity?
     *
     * @return boolean
     *         TRUE if we can edit this entity
     *         FALSE otherwise
     */
    public function isReadWrite()
    {
        if ($this->readOnly) {
            return false;
        }

        return true;
    }

    /**
     * disable editing this entity
     *
     * @return void
     */
    public function setReadOnly()
    {
        $this->readOnly = true;
    }

    /**
     * enable editing this entity
     *
     * @return void
     */
    public function setReadWrite()
    {
        $this->readOnly = false;
    }

    /**
     * throw an exception if the object is not in read-write mode
     *
     * @return void
     * @throws ReadOnlyException
     */
    protected function requireReadWrite()
    {
        if (!$this->readOnly) {
            return;
        }

        // if we get here, we are in read-only mode, and cannot be edited
        $type = GetPrintableType::of($this);

        throw new ReadOnlyException("{$type} is read-only; cannot edit");
    }
}
