<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices\Tests;

use PHPUnit\Runner\Version;

/**
 * @internal
 */
trait HelperTrait
{
    public function markTestSkippedIfPHPUnitMethodIsMissing($method)
    {
        if (!is_callable(array($this, $method))) {
            static::markTestSkipped(sprintf(
                'PHPUnit %s is not providing "%s" method.',
                Version::id(),
                $method
            ));
        }
    }
}
