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

use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\Traits\ExpectationViaCodeOverAnnotationTrait;
use PHPUnitGoodPractices\Traits\Reporter;

/**
 * @covers \PHPUnitGoodPractices\Traits\ExpectationViaCodeOverAnnotationTrait
 *
 * @internal
 */
final class ExpectationViaCodeOverAnnotationTraitTest extends TestCase
{
    use ExpectationViaCodeOverAnnotationTrait;
    use HelperTrait;

    /**
     * @expectedException \Exception
     */
    public function fixture()
    {
        throw new \Exception();
    }

    public function testSetExpectedExceptionFromAnnotation()
    {
        $testClass = new self('fixture');

        $counter = 0;
        $customReporter = function () use (&$counter) { ++$counter; };

        Reporter::setCustomReporter($customReporter);

        $testClass->runBare();

        static::assertSame(1, $counter);

        Reporter::clearCustomReporter();
    }

    public function testExpectException()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('expectException');

        $this->expectException('Exception');

        throw new \Exception();
    }

    public function testSetExpectedException()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('setExpectedException');

        $this->setExpectedException('Exception');

        throw new \Exception();
    }
}
