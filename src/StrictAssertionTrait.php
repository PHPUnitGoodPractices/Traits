<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices;

trait StrictAssertionTrait
{
    public static function assertEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        // internally, PHPUnit calls `assertEquals` instead of `assertSame` internally, we allow that
        if ('assertSame' !== $trace[1]['function']) {
            Reporter::report("PHPUnit good practice has been abused.\nUse `->assertSame()` instead of `->assertEquals()`.");
        }

        return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
    }
}
