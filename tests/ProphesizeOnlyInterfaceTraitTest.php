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
use PHPUnitGoodPractices\Traits\ProphesizeOnlyInterfaceTrait;

interface FixtureInterface
{
}

/**
 * @covers \PHPUnitGoodPractices\Traits\ProphesizeOnlyInterfaceTrait
 *
 * @internal
 */
final class ProphesizeOnlyInterfaceTraitTest extends TestCase
{
    use HelperTrait;
    use PolyfillTrait;
    use ProphesizeOnlyInterfaceTrait;

    public function testProphecyOfNothing()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->prophesize();
        static::assertTrue(true);
    }

    public function testProphecyOfInterface()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->prophesize(FixtureInterface::class);
        static::assertTrue(true);
    }

    public function testProphecyOfClass()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectWarningWithFallback();
        $this->prophesize('Exception');
    }

    public function testProphecyOfNonExistingClass()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectWarningWithFallback();
        $this->prophesize('FooBarBaz');
    }
}
