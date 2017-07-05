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
 * @package   MissingBits/TypeChecks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\TypeChecks;

use GanbaroDigital\MissingBits\Checks\Check;
use GanbaroDigital\MissingBits\TypeInterfaces\CanBeEmpty;
use stdClass;
use Traversable;

/**
 * do we have something that is empty?
 */
class IsEmpty implements Check
{
    /**
     * fluent-interface entry point
     *
     * we do not support any customisations
     *
     * @return IsEmpty
     */
    public static function using()
    {
        return new static();
    }

    /**
     * check if an item is empty
     *
     * empty means one of:
     * - item itself is empty
     * - item is a data container, and only contains empty data items
     *
     * BE AWARE that this check WILL descend down into the contents of $fieldOrVar
     * until it finds the first piece of non-empty data. This has the potential
     * to be computationally expensive.
     *
     * @param  mixed $fieldOrVar
     *         the item to check
     * @return bool
     *         TRUE if the item is empty
     *         FALSE otherwise
     */
    public static function check($fieldOrVar)
    {
        // general case
        if (is_null($fieldOrVar)) {
            return true;
        }

        // type-specific checks
        if (is_array($fieldOrVar)) {
            return self::checkArray($fieldOrVar);
        }
        if ($fieldOrVar instanceof Traversable || $fieldOrVar instanceof stdClass) {
            return self::checkTraversable($fieldOrVar);
        }
        if ($fieldOrVar instanceof CanBeEmpty) {
            return $fieldOrVar->isEmpty();
        }

        if (is_string($fieldOrVar)) {
            return self::checkString($fieldOrVar);
        }

        // if we get here, we've run out of ways to check
        return false;
    }

    /**
     * check if an item is empty
     *
     * empty means one of:
     * - item itself has no content
     * - item is a data container, and only contains empty data items
     *
     * BE AWARE that this check WILL descend down into the contents of $fieldOrVar
     * until it finds the first piece of non-empty data. This has the potential
     * to be computationally expensive.
     *
     * @param  array $fieldOrVar
     *         the item to check
     * @return bool
     *         TRUE if the item is empty
     *         FALSE otherwise
     */
    private static function checkArray($fieldOrVar)
    {
        if (count($fieldOrVar) === 0) {
            return true;
        }

        return self::checkTraversable($fieldOrVar);
    }

    /**
     * check if an item is empty
     *
     * empty means one of:
     * - the string has zero length
     * - the string only contains whitespace
     *
     * @param  string $fieldOrVar
     *         the item to check
     * @return bool
     *         TRUE if the item is empty
     *         FALSE otherwise
     */
    private static function checkString($fieldOrVar)
    {
        if (trim((string)$fieldOrVar) === '') {
            return true;
        }

        return false;
    }

    /**
     * check if an item is empty
     *
     * empty means one of:
     * - item itself has no content
     * - item is a data container, and only contains empty data items
     *
     * BE AWARE that this check WILL descend down into the contents of $fieldOrVar
     * until it finds the first piece of non-empty data. This has the potential
     * to be computationally expensive.
     *
     * @param  array $fieldOrVar
     *         the item to check
     * @return bool
     *         TRUE if the item is empty
     *         FALSE otherwise
     */
    private static function checkTraversable($fieldOrVar)
    {
        foreach ($fieldOrVar as $value) {
            if (!self::check($value)) {
                return false;
            }
        }

        // if we get here, item's contents are entirely empty
        return true;
    }

    /**
     * check if an item is empty
     *
     * empty means one of:
     * - item itself is empty
     * - item is a data container, and only contains empty data items
     *
     * BE AWARE that this check WILL descend down into the contents of $fieldOrVar
     * until it finds the first piece of non-empty data. This has the potential
     * to be computationally expensive.
     *
     * @param  mixed $fieldOrVar
     *         the item to check
     * @return bool
     *         TRUE if the item is empty
     *         FALSE otherwise
     */
    public function inspect($fieldOrVar)
    {
        return static::check($fieldOrVar);
    }
}
