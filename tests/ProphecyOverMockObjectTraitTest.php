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

use PHPUnitGoodPractices\Polyfill\PolyfillTrait;
use PHPUnitGoodPractices\Traits\ProphecyOverMockObjectTrait;

/**
 * @covers \PHPUnitGoodPractices\Traits\ProphecyOverMockObjectTrait
 *
 * @internal
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

        $this->expectWarningWithFallback();
        $this->createMock('Exception');
    }

    public function testGetMockClassFails()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('getMockClass');
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectWarningWithFallback();
        $this->getMockClass('Exception');
    }

    public function testCreateMockWorksWhenNoProphecy()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('createMock');
        $this->markTestSkippedIfPHPUnitMethodExists('prophesize');

        $this->createMock('Exception');
        static::assertTrue(true);
    }

    public function testGetMockClassWorksWhenNoProphecy()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('getMockClass');
        $this->markTestSkippedIfPHPUnitMethodExists('prophesize');

        $this->getMockClass('Exception');
        static::assertTrue(true);
    }
}
