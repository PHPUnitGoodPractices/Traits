<?php declare(strict_types=1);

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
trait PolyfillTrait7
{
    public function expectException(string $exception): void
    {
        if (is_callable(['parent', 'expectException'])) {
            parent::expectException($exception);
        } else {
            $this->setExpectedException($exception);
        }
    }
}
