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
 * @package   MissingBits\Checks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\Checks;

use GanbaroDigital\MissingBits\TypeChecks\IsList;
use GanbaroDigital\MissingBits\TypeInspectors\GetPrintableType;
use TypeError;

/**
 * base class for anything that wants to check a list of values
 */
class CheckList
{
    /**
     * the check that we'll apply to everything in the list
     * @var Check[]
     */
    private $checks;

    /**
     * create a customised CheckList, ready to use
     *
     * @param array $checks
     *        a list of checks to apply
     */
    protected function __construct(array $checks)
    {
        $this->checks = $checks;
    }

    /**
     * does a list of values pass inspection?
     *
     * we apply the list of checks that you passed into our constructor
     *
     * @param  mixed $list
     *         the list of data to be examined
     * @return bool
     *         TRUE if the inspection passes
     *         FALSE otherwise
     * @throws TypeError
     *         if $list isn't a list we can use
     */
    public function inspect($list)
    {
        // robustness
        if (!IsList::check($list)) {
            throw new TypeError('$list is not a list, is a ' . GetPrintableType::of($list));
        }

        // a simple nested foreach() is all that we need here
        foreach ($list as $name => $item) {
            foreach ($this->checks as $check) {
                if (!$check->inspect($item)) {
                    // no need to continue
                    return false;
                }
            }
        }

        // if we get here, then all is good
        return true;
    }
}
