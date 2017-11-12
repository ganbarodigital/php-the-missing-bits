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
 * @package   MissingBits/ConsoleOutput
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

namespace GanbaroDigital\MissingBits\ConsoleOutput;

/**
 * echo a character for each item, along with '[x / y]' to show overall
 * progress
 */
class ShowProgress
{
    /**
     * echo a character for each item, along with '[x / y]' to show overall
     * progress
     *
     * @param  string $progressChar
     *         what should we output?
     *         this should be a single character; ASCII codes are fine
     *         as long as they only move the cursor 1 character to the
     *         right after they have completed
     * @param  int $currentProgress
     *         how much progress has been made?
     * @param  int $maxProgress
     *         what is the maximum value of $currentProgress?
     * @param  int $consoleWidth
     *         how wide is the terminal display?
     *         default assumes UNIX standard width of 80 chars
     * @param  callback $printerFunc
     *         what should we use to write to the console?
     *         this needs to accept printf() arguments
     * @return string
     *         anything returned by your $printerFunc
     */
    public static function with($progressChar, $currentProgress, $maxProgress, $consoleWidth = 80, $printerFunc = 'printf')
    {
        // build the current progress
        //
        // we do this to ensure that we call `$printerFunc` a maximum
        // of once
        //
        // hopefully this is better for performance
        $format = "%s";
        $formatParams = [ $progressChar ];

        // do we need to output anything else?
        $maxString = (string)$maxProgress;
        $maxPerRow = $consoleWidth - 10 - (strlen($maxString) * 2);
        $remainderPerRow = $currentProgress % $maxPerRow;

        // have we reached 100% progress?
        if ($currentProgress == $maxProgress) {
            $format .= "%s";
            $formatParams[] = str_repeat(' ', $remainderPerRow);

            list($format, $formatParams) = self::addProgressCount($currentProgress, $maxProgress, $format, $formatParams);
        }
        else if ($remainderPerRow === 0) {
            // we have reached the end of the console line
            list($format, $formatParams) = self::addProgressCount($currentProgress, $maxProgress, $format, $formatParams);
        }

        // all done
        return call_user_func_array($printerFunc, array_append_values([$format], $formatParams));
    }

    /**
     * add a summary of progress to date to the existing format string
     * and associated parameters
     *
     * @param  int $currentProgress
     * @param  int $maxProgress
     * @param  string $format
     * @param  array $formatParams
     * @return array
     */
    private static function addProgressCount($currentProgress, $maxProgress, $format, $formatParams)
    {
        $maxString = (string)$maxProgress;
        $format .= ' [%' . strlen($maxString) . 's / %s]' . PHP_EOL;
        $formatParams[] = (string)$currentProgress;
        $formatParams[] = $maxString;

        return [ $format, $formatParams ];
    }
}