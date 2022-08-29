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

use PHPUnitGoodPractices\Traits\IdentityOverEqualityTrait;
use PHPUnitGoodPractices\Traits\Reporter;

/**
 * @covers \PHPUnitGoodPractices\Traits\Reporter
 *
 * @internal
 */
final class ReporterTest extends TestCase
{
    use HelperTrait;
    use IdentityOverEqualityTrait;

    public function testReportWithDefaults()
    {
        $expectedMessage = "PHPUnit good practice has been violated.\nFoo.";

        $this->expectWarningWithFallback($expectedMessage);

        Reporter::report('Foo.');
    }

    public function testReportWithoutHeaders()
    {
        Reporter::useHeader(false);

        $expectedMessage = 'Foo.';

        $this->expectWarningWithFallback($expectedMessage);

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
        $this->expectWarningWithFallback();
        Reporter::report('Foo.');
    }

    public function testObservedAssertionCrashesTestExecutionWhileUsingDefaultReporter()
    {
        $this->expectWarningWithFallback();

        static::assertEquals(1, 1);
    }

    protected function legacyTearDown()
    {
        // reset global `Reporter` state
        Reporter::useHeader(true);
        Reporter::clearCustomReporter();
    }
}
