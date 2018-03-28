<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices\Traits;

/*
 * Identity (`===`) assertions shall be used over equality (`==`) ones.
 *
 * `assertSame` instead of `assertEquals`
 * `assertNotSame` instead of `assertNotEquals`
 * `assertAttributeSame` instead of `assertAttributeEquals`
 * `assertAttributeNotSame` instead of `assertAttributeNotEquals`
 */
if (version_compare(PHPUnitVersionRetriever::getVersion(), '7.0.0') < 0) {
    trait IdentityOverEqualityTrait
    {
        public static function assertEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
        {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

            // sometimes, PHPUnit calls `assertEquals` instead of `assertSame` internally, we allow that
            if (!in_array(
                $trace[1]['function'],
                [
                    'assertJsonStringEqualsJsonString',
                    'assertSame',
                    'assertStringEqualsFile',
                    'assertXmlStringEqualsXmlString',
                ],
                true
            )) {
                Reporter::report('Use `->assertSame()` instead of `->assertEquals()`.');
            }

            call_user_func_array(['parent', __FUNCTION__], func_get_args());
        }

        public static function assertNotEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
        {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

            // sometimes, PHPUnit calls `assertEquals` instead of `assertSame` internally, we allow that
            if ('assertNotSame' !== $trace[1]['function']) {
                Reporter::report('Use `->assertNotSame()` instead of `->assertNotEquals()`.');
            }

            call_user_func_array(['parent', __FUNCTION__], func_get_args());
        }

        public static function assertAttributeEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
        {
            // need to override the method, as original on v4 is not using Late Static Binding
            static::assertEquals(
                $expected,
                self::readAttribute($actualClassOrObject, $actualAttributeName),
                $message,
                $delta,
                $maxDepth,
                $canonicalize,
                $ignoreCase
            );
        }

        public static function assertAttributeNotEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
        {
            // need to override the method, as original on v4 is not using Late Static Binding
            static::assertNotEquals(
                $expected,
                self::readAttribute($actualClassOrObject, $actualAttributeName),
                $message,
                $delta,
                $maxDepth,
                $canonicalize,
                $ignoreCase
            );
        }
    }
} else {
    trait IdentityOverEqualityTrait
    {
        use IdentityOverEqualityTrait7;
    }
}
