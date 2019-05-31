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
use PHPUnitGoodPractices\Traits\IdentityOverEqualityTrait;
use PHPUnitGoodPractices\Traits\Reporter;

/**
 * @covers \PHPUnitGoodPractices\Traits\Reporter
 *
 * @internal
 */
final class ReporterTest extends TestCase
{
    use IdentityOverEqualityTrait;

    protected function tearDown()
    {
        // reset global `Reporter` state
        Reporter::useHeader(true);
        Reporter::clearCustomReporter();
    }

    public function testReportWithDefaults()
    {
        $expectedMessage = "PHPUnit good practice has been violated.\nFoo.";

        if (\is_callable([$this, 'expectException'])) {
            $this->expectException(Warning::class);
            $this->expectExceptionMessage($expectedMessage);
        } else {
            $this->setExpectedException(Warning::class, $expectedMessage);
        }

        Reporter::report('Foo.');
    }

    public function testReportWithoutHeaders()
    {
        Reporter::useHeader(false);

        $expectedMessage = 'Foo.';

        if (\is_callable([$this, 'expectException'])) {
            $this->expectException(Warning::class);
            $this->expectExceptionMessage($expectedMessage);
        } else {
            $this->setExpectedException(Warning::class, $expectedMessage);
        }

        Reporter::report('Foo.');
    }

    public function testReportWithCustomReporter()
    {
        $counter = 0;
        $customReporter = function () use (&$counter) { ++$counter; };

        Reporter::setCustomReporter($customReporter);
        Reporter::report('Foo.');
        static::assertSame(1, $counter); // custom reporter shall be triggered
    }

    public function testReportAfterClearingCustomReporter()
    {
        $customReporter = function () { };

        Reporter::setCustomReporter($customReporter);
        Reporter::report('Foo.');

        Reporter::clearCustomReporter();
        if (\is_callable([$this, 'expectException'])) {
            $this->expectException(Warning::class);
        } else {
            $this->setExpectedException(Warning::class);
        }
        Reporter::report('Foo.');
    }

    public function testObservedAssertionCrashesTestExecutionWhileUsingDefaultReporter()
    {
        if (\is_callable([$this, 'expectException'])) {
            $this->expectException(Warning::class);
        } else {
            $this->setExpectedException(Warning::class);
        }

        static::assertEquals(1, 1);
    }
}
