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

use PHPUnit\Util\Test;

/*
 * Expected exception shall be set up via code, not annotations.
 *
 * `->expectExeption*()` or `->setExpectedException*()` instead of `@expectedException*`
 */
if (version_compare(PHPUnitVersionRetriever::getVersion(), '7.0.0') < 0) {
    trait ExpectationViaCodeOverAnnotationTrait
    {
        protected function setExpectedExceptionFromAnnotation()
        {
            if (class_exists(Test::class)) {
                $expectedException = Test::getExpectedException(
                    static::class,
                    $this->getName(false)
                );
            } else {
                $expectedException = \PHPUnit_Util_Test::getExpectedException(
                    static::class,
                    $this->getName(false)
                );
            }

            if (false !== $expectedException) {
                Reporter::report('Use `->expectExeption*()` or `->setExpectedException*()` instead of `@expectedException*`.');
                parent::setExpectedExceptionFromAnnotation();
            }

            // no need to call parent method if $expectedException is empty
        }
    }
} elseif (version_compare(PHPUnitVersionRetriever::getVersion(), '9.0.0') < 0) {
    trait ExpectationViaCodeOverAnnotationTrait
    {
        use ExpectationViaCodeOverAnnotationTrait7;
    }
} else {
    trait ExpectationViaCodeOverAnnotationTrait
    {
        // removed from PHPUnit, PHPUnit will crash on it's own
    }
}
