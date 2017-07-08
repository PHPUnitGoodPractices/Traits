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
use PHPUnitGoodPractices\ExpectationViaCodeOverAnnotationTrait;
use PHPUnitGoodPractices\Reporter;

/**
 * @covers \PHPUnitGoodPractices\ExpectationViaCodeOverAnnotationTrait
 */
final class ExpectationViaCodeOverAnnotationTraitTest extends TestCase
{
    use ExpectationViaCodeOverAnnotationTrait;

    public function getName($withDataSet = true)
    {
        // partial mock for `testExpectationViaAnnotationFails` test
        foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) as $trace) {
            if (
                'PHPUnitGoodPractices\Tests\ExpectationViaCodeOverAnnotationTraitTest' === $trace['class'] &&
                'testExpectationViaAnnotationFails' === $trace['function']
            ) {
                return 'fixture_testExpectationViaAnnotationFails';
            }
        }

        return parent::getName($withDataSet);
    }

    /**
     * @expectedException \Exception
     */
    public function fixture_testExpectationViaAnnotationFails()
    {
    }

    public function testExpectationViaAnnotationFails()
    {
        $counter = 0;
        $customReporter = function () use (&$counter) { ++$counter; };

        Reporter::setCustomReporter($customReporter);

        $this->setExpectedExceptionFromAnnotation();

        $this->assertSame(1, $counter);

        Reporter::clearCustomReporter();
    }

    public function testExpectationViaCodeWorks()
    {
        $this->expectException('Exception');

        throw new \Exception();
    }
}
