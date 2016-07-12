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
 * @package   MissingBits/StringFunctions
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

/**
* surround an array key with single quotes if appropriate
*
* If $key isn't a string, no quotes are added.
*
* @param  mixed $key
*         the item to (possibly) quote
* @return mixed
*         the unmodified $key if it is not a string
*         the quoted $key if it is a string
*/
function quote_index($key) {
    if (!is_string($key)) {
        return $key;
    }

    return "'$key'";
}

/**
 * surround a string with braces, if it would need braces in order to be used
 * as a PHP property name in eval()
 *
 * @param  string $propertyName
 *         the property name to add braces to (if required)
 * @return string
 */
function quote_property($propertyName) {
    // robustness!
    if (!is_stringy($propertyName)) {
        throw new InvalidArgumentException('$propertyName is not a valid class or object property name');
    }

    // would the string need braces if we used it in eval()?
    //
    // the rules are:
    // - first character must be an ASCII letter or an underscore
    // - the remaining characters can only be ASCII letters, numbers,
    //   or an underscore
    //
    // any string that doesn't satisfy those rules needs braces adding
    if (!preg_match("/[A-Za-z_][A-Za-z0-9_]{" . (strlen($propertyName) - 1) . "}/", $propertyName)) {
        // yes it would
        return '{' . $propertyName . '}';
    }

    // if we get here, then no action is needed
    return $propertyName;
}

if (!function_exists("vnsprintf")) {

/**
 * vsprintf()-compatible function, with support for named parameters in the
 * format string
 *
 * Internally, we convert named parameters into positional parameters. This
 * means that your format string:
 *
 * - must be a pure vsprintf()-compatible format string, or
 * - must use only named parameters, or
 * - must use a mix of named parameters and positional parameters
 *
 * You CANNOT mix named parameters and non-positional parameters.
 *
 * @param  string $format
 *         the format string to use
 * @param  array args
 *         the list of parameters to use
 * @return string
 *         the result of expanding $format
 */
function vnsprintf($format, $args)
{
    // we need to find all of the named parameters to expand
    $regex = "|(?<!%)(?:%)([^0-9].+)(?:\\\$)|U";

    $matches = [];
    $matchCount = preg_match_all($regex, $format, $matches, PREG_OFFSET_CAPTURE);
    if ($matchCount === 0) {
        // nothing to do
        return vsprintf($format, $args);
    }

    // if we get here, then we have some matches to expand
    // we're going to add them to the end of this array
    $messageData = $args;

    // this will keep track of where we've added the data
    $nextData = count($messageData);
    $paramKeys = array_fill_keys(array_keys($args), -1);

    // this will keep track of how we've shrunk the format string
    $formatChange = 0;

    // transform the named parameters into offset parameters
    foreach ($matches[1] as $match) {
        // what is the named parameter?
        $paramName = $match[0];

        // make sure the named parameter exists in our original data
        if (!isset($paramKeys[$paramName])) {
            throw new InvalidArgumentException("vnsprintf: named format-string parameter " . $paramName . " is not provided in \$args array");
        }
        // have we already assigned it a place in $messageData?
        // in case a named parameter appears multiple times in the format string
        if ($paramKeys[$paramName] === -1) {
            // no - it needs a home
            $messageData[$nextData] =& $args[$paramName];
            $paramKeys[$paramName] = $nextData;
            $nextData++;
        }
        // convert the named parameter in the format string into a positional
        // parameter into $messageData
        $paramOffset = $paramKeys[$paramName] + 1;
        $format = substr_replace($format, $paramOffset, $formatChange + $match[1], strlen($paramName));

        // how much did we shrink / grow the format string by?
        $formatChange = $formatChange - strlen($paramName) + strlen($paramOffset);
    }

    // all done
    return vsprintf($format, $messageData);
}

}
