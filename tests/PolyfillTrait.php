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

use PHPUnitGoodPractices\Traits\PHPUnitVersionRetriever;

/*
 * @internal
 */
if (version_compare(PHPUnitVersionRetriever::getVersion(), '7.0.0') < 0) {
    trait PolyfillTrait
    {
        public function expectException($exception)
        {
            if (is_callable(['parent', 'expectException'])) {
                parent::expectException($exception);
            } else {
                $this->setExpectedException($exception);
            }
        }
    }
} else {
    trait PolyfillTrait
    {
        use PolyfillTrait7;
    }
}
