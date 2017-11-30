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

/**
 * @internal
 */
final class PHPUnitVersionRetriever
{
    public static function getVersion()
    {
        return class_exists('PHPUnit\Runner\Version')
            ? \PHPUnit\Runner\Version::id()
            : \PHPUnit_Runner_Version::id();
    }
}
