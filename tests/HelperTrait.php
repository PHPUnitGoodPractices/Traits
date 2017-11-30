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

use PHPUnit\Runner\Version;

/**
 * @internal
 */
trait HelperTrait
{
    public function markTestSkippedIfPHPUnitMethodIsMissing($method)
    {
        if (!is_callable([$this, $method])) {
            static::markTestSkipped(sprintf(
                'Skipping, as PHPUnit %s is not providing "%s" method.',
                Version::id(),
                $method
            ));
        }
    }

    public function markTestSkippedIfPHPUnitMethodExists($method)
    {
        if (is_callable([$this, $method])) {
            static::markTestSkipped(sprintf(
                'Skipping, as PHPUnit %s is providing "%s" method.',
                Version::id(),
                $method
            ));
        }
    }
}
