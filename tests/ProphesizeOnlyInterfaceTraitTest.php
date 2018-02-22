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
use PHPUnitGoodPractices\Traits\ProphesizeOnlyInterfaceTrait;

interface FixtureInterface
{
}

/**
 * @covers \PHPUnitGoodPractices\Traits\ProphesizeOnlyInterfaceTrait
 */
final class ProphesizeOnlyInterfaceTraitTest extends TestCase
{
    use HelperTrait;
    use PolyfillTrait;
    use ProphesizeOnlyInterfaceTrait;

    public function testProphecyOfInterface()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->prophesize(FixtureInterface::class);
        $this->assertTrue(true);
    }

    public function testProphecyOfClass()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectException(Warning::class);
        $this->prophesize('Exception');
    }

    public function testProphecyOfNonExistingClass()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('prophesize');

        $this->expectException(Warning::class);
        $this->prophesize('FooBarBaz');
    }
}
