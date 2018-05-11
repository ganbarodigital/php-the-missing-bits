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
 * @package   MissingBits/ArrayFunctions
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://ganbarodigital.github.io/php-the-missing-bits
 */

/**
 * append one array to another, ignoring the array keys in $extra
 *
 * added because of the observed performance problems with array_merge()
 * at scale
 *
 * @param  array $target
 *         the array to append to
 * @param  array $extra
 *         the array that we want to append
 * @return array
 *         the combined array
 */
function array_append_values(array $target, array $extra)
{
    $retval = $target;
    foreach ($extra as $value) {
        $retval[] = $value;
    }

    // all done
    return $retval;
}

/**
 * append one array to another, respecting the array keys in $extra
 *
 * added because of the observed performance problems with array_merge()
 * at scale
 *
 * @param  array $target
 *         the array to merge into
 * @param  array $extra
 *         the array that we want to merge with $target
 * @return array
 *         the combined array
 */
function array_merge_keys($target, $extra)
{
    $retval = $target;
    foreach ($extra as $key => $value) {
        $retval[$key] = $value;
    }

    // all done
    return $retval;
}

/**
 * build a subset of an array, that only consists of content that has
 * been explicitly whitelisted
 *
 * we only keep:
 * - keys in $target
 * - that have a corresponding filter in $filterMap
 * - where the corresponding filter:
 *   - is `true`
 *   - or is a `callable`
 *
 * we support child arrays, with corresponding child array filters
 *
 * @param  array $target
 *         the array we want to filter
 * @param  array $filterMap
 *         list of whitelisted fields
 * @return array
 *         the resulting filtered array
 */
function array_whitelist(array $target, array $filterMap)
{
    // step 1: drop all filters that are FALSE
    //
    // it's a thing, what can I say?
    $filterMap = array_filter($filterMap);

    // step 2: first pass at fields that are whitelisted
    //
    // with simple filterMaps, this will do all the work
    $retval = array_intersect_key($target, $filterMap);

    // step 3: apply remaining filters
    foreach ($filterMap as $key => $filter) {
        switch(true) {
            case is_callable($filter):
                $retval[$key] = $filter($retval);
                break;

            // support for n-depth filters
            case isset($retval[$key]) && is_array($filter) && (is_array($retval[$key]) || is_object($retval[$key])):
                $retval[$key] = array_whitelist($retval[$key], $filter);
                break;
        }

        // var_dump($key, $filter, $retval, $target);
    }

    return $retval;
}

function array_filter_contents(array $target, array $filterMap)
{
    $retval = $target;

    foreach ($filterMap as $key => $filter) {
        // nothing needs doing
        if (!isset($retval[$key]) || $filter === true) {
            continue;
        }

        // we want to remove this field
        if ($filter === false) {
            unset($retval[$key]);
            continue;
        }

        if (is_callable($filter)) {
            $retval[$key] = $filter($retval);
            continue;
        }

        if (is_array($retval[$key]) && is_array($filter)) {
            $retval[$key] = array_filter_contents($retval[$key], $filter);
        }
    }

    return $retval;
}

function array_quote(array $data, string $separator = ',', string $quote = '"')
{
    return $quote . implode($quote . $separator . $quote, $data) . $quote;
}