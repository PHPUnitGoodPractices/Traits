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

use PHPUnit\Util\Test;
use PHPUnit_Util_Test;

/**
 * Expected exception shall be set up via code, not assertions.
 *
 * `->expectExeption*()` or `->setExpectedException*()` instead of `@expectedException*`
 */
trait ExpectationViaCodeOverAnnotationTrait
{
    protected function setExpectedExceptionFromAnnotation()
    {
        if (class_exists(Test::class)) {
            $expectedException = Test::getExpectedException(
                get_class($this),
                $this->getName(false)
            );
        } else {
            $expectedException = PHPUnit_Util_Test::getExpectedException(
                get_class($this),
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
