<?php

declare(strict_types=1);

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

trait ExpectationViaCodeOverAnnotationTrait7
{
    public function runBare(): void
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
        }

        parent::runBare();
    }
}
