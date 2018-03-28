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
use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\Polyfill\PolyfillTrait;
use PHPUnitGoodPractices\Traits\ProphecyOverMockObjectTrait;

/**
 * @covers \PHPUnitGoodPractices\Traits\ProphecyOverMockObjectTrait
 */
final class ProphecyOverMockObjectTraitTest extends TestCase
{
    use HelperTrait;
    use PolyfillTrait;
    use ProphecyOverMockObjectTrait;

    public function testCreateMockFails()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('createMock');
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectException(Warning::class);
        $this->createMock('Exception');
    }

    public function testGetMockClassFails()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('getMockClass');
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectException(Warning::class);
        $this->getMockClass('Exception');
    }

    public function testCreateMockWorksWhenNoProphecy()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('createMock');
        $this->markTestSkippedIfPHPUnitMethodExists('prophesize');

        $this->createMock('Exception');
        $this->assertTrue(true);
    }

    public function testGetMockClassWorksWhenNoProphecy()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('getMockClass');
        $this->markTestSkippedIfPHPUnitMethodExists('prophesize');

        $this->getMockClass('Exception');
        $this->assertTrue(true);
    }
}
