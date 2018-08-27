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

if (version_compare(PHPUnitVersionRetriever::getVersion(), '4.5') < 0) {
    trait ProphesizeOnlyInterfaceTrait
    {
    }
} elseif (version_compare(PHPUnitVersionRetriever::getVersion(), '7.0') < 0) {
    trait ProphesizeOnlyInterfaceTrait
    {
        protected function prophesize($classOrInterface = null)
        {
            if ($classOrInterface && !interface_exists($classOrInterface)) {
                Reporter::report('Prophecy shall be created only for (existing) interfaces.');
            }

            return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
        }
    }
} else {
    trait ProphesizeOnlyInterfaceTrait
    {
        use ProphesizeOnlyInterfaceTrait7;
    }
}
