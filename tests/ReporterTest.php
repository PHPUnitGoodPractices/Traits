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
use PHPUnitGoodPractices\Reporter;

/**
 * @covers \PHPUnitGoodPractices\Reporter
 */
final class ReporterTest extends TestCase
{
    public function tearDown()
    {
        // reset global `Reporter` state
        Reporter::useHeader(true);
        Reporter::clearCustomReporter();
    }

    public function testReportWithDefaults()
    {
        $expectedMessage = "PHPUnit good practice has been abused.\nFoo.";

        if (is_callable(array($this, 'expectException'))) {
            $this->expectException(\PHPUnit_Framework_Error_Warning::class);
            $this->expectExceptionMessage($expectedMessage);
        } else {
            $this->setExpectedException(\PHPUnit_Framework_Error_Warning::class, $expectedMessage);
        }

        Reporter::report('Foo.');
    }

    public function testReportWithoutHeaders()
    {
        Reporter::useHeader(false);

        $expectedMessage = 'Foo.';

        if (is_callable(array($this, 'expectException'))) {
            $this->expectException(\PHPUnit_Framework_Error_Warning::class);
            $this->expectExceptionMessage($expectedMessage);
        } else {
            $this->setExpectedException(\PHPUnit_Framework_Error_Warning::class, $expectedMessage);
        }

        Reporter::report('Foo.');
    }

    public function testReportWithCustomReporter()
    {
        $counter = 0;
        $customReporter = function () use (&$counter) { ++$counter; };

        Reporter::setCustomReporter($customReporter);
        Reporter::report('Foo.');
        $this->assertSame(1, $counter); // custom reporter shall be triggered
    }

    public function testReportAfterClearingCustomReporter()
    {
        $customReporter = function () { };

        Reporter::setCustomReporter($customReporter);
        Reporter::report('Foo.');

        Reporter::clearCustomReporter();
        if (is_callable(array($this, 'expectException'))) {
            $this->expectException(\PHPUnit_Framework_Error_Warning::class);
        } else {
            $this->setExpectedException(\PHPUnit_Framework_Error_Warning::class);
        }
        Reporter::report('Foo.');
    }
}
