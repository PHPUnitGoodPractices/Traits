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

trait ProphesizeOnlyInterfaceTrait7
{
    protected function prophesize($classOrInterface = null): \Prophecy\Prophecy\ObjectProphecy
    {
        if ($classOrInterface && !interface_exists($classOrInterface)) {
            Reporter::report('Prophecy shall be created only for (existing) interfaces.');
        }

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }
}
