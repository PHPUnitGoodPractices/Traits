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

use PHPUnitGoodPractices\Traits\ExpectOverSetExceptionTrait;
use PHPUnitGoodPractices\Traits\Reporter;

/**
 * @covers \PHPUnitGoodPractices\Traits\ExpectOverSetExceptionTrait
 *
 * @internal
 */
final class ExpectOverSetExceptionTraitTest extends TestCase
{
    use ExpectOverSetExceptionTrait;
    use HelperTrait;

    public $violations = [];

    public function testSetExpectedExceptionWithNull()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('setExpectedException');

        $this->setExpectedException(null);
        static::assertCount(1, $this->violations);
        static::assertRegExp('/.*null.*/', $this->violations[0]);
    }

    public function testSetExpectedExceptionRegExpWithNull()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('setExpectedExceptionRegExp');

        $this->setExpectedExceptionRegExp(null);
        static::assertCount(1, $this->violations);
        static::assertRegExp('/.*null.*/', $this->violations[0]);
    }

    public function testSetExpectedException()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('setExpectedException');
        $this->markTestSkippedIfPHPUnitMethodIsMissing('expectException');

        $this->setExpectedException(\Exception::class);
        static::assertCount(1, $this->violations);
        static::assertRegExp('/.*expectExeption.*/', $this->violations[0]);

        throw new \Exception();
    }

    public function testSetExpectedExceptionRegExp()
    {
        $this->markTestSkippedIfPHPUnitMethodIsMissing('setExpectedExceptionRegExp');
        $this->markTestSkippedIfPHPUnitMethodIsMissing('expectException');

        $this->setExpectedExceptionRegExp(\Exception::class, '/.*/');
        static::assertCount(1, $this->violations);
        static::assertRegExp('/.*expectExeption.*/', $this->violations[0]);

        throw new \Exception();
    }

    protected function legacySetUp()
    {
        $this->violations = [];
        $self = $this;
        $customReporter = function ($issue) use ($self) { $self->violations[] = $issue; };
        Reporter::setCustomReporter($customReporter);
    }

    protected function legacyTearDown()
    {
        Reporter::clearCustomReporter();
    }
}
