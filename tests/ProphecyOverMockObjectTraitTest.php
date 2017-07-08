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

use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\ProphecyOverMockObjectTrait;

/**
 * @covers \PHPUnitGoodPractices\ProphecyOverMockObjectTrait
 */
final class ProphecyOverMockObjectTraitTest extends TestCase
{
    use ProphecyOverMockObjectTrait;

    public function testTODO()
    {
        $this->assertTrue('TODO');
    }
}
