<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices\Traits\Tests;

use PHPUnit\Framework\Error\Warning;
use PHPUnit\Runner\Version;

/**
 * @internal
 */
trait HelperTrait
{
    public function expectWarningWithFallback($expectedMessage = null)
    {
        if (\is_callable([$this, 'expectWarning'])) {
            $this->expectWarning();
            if ($expectedMessage) {
                $this->expectWarningMessage($expectedMessage);
            }
        } elseif (\is_callable([$this, 'expectException'])) {
            $this->expectException(Warning::class);
            if ($expectedMessage) {
                $this->expectExceptionMessage($expectedMessage);
            }
        } else {
            $this->setExpectedException(Warning::class, $expectedMessage);
        }
    }

    public function markTestSkippedIfPHPUnitMethodIsMissing($method)
    {
        if (!\is_callable([$this, $method])) {
            static::markTestSkipped(sprintf(
                'Skipping, as PHPUnit %s is not providing "%s" method.',
                Version::id(),
                $method
            ));
        }
    }

    public function markTestSkippedIfPHPUnitMethodExists($method)
    {
        if (\is_callable([$this, $method])) {
            static::markTestSkipped(sprintf(
                'Skipping, as PHPUnit %s is providing "%s" method.',
                Version::id(),
                $method
            ));
        }
    }
}
