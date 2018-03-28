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

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\Traits\IdentityOverEqualityTrait;
use PHPUnitGoodPractices\Traits\Reporter;

/**
 * @covers \PHPUnitGoodPractices\Traits\IdentityOverEqualityTrait
 */
final class IdentityOverEqualityTraitTest extends TestCase
{
    use IdentityOverEqualityTrait;

    public $fixtureAttributeBool = true;
    public $fixtureAttributeInt = 123;

    public function tearDown()
    {
        Reporter::clearCustomReporter();
    }

    /**
     * @param string  $assertionMethod
     * @param mixed[] $callArgs
     * @param bool    $shouldCrash
     */
    public function assertAssertionExecution($assertionMethod, array $callArgs, $shouldCrash)
    {
        $failed = false;
        $crashed = false;

        $shouldFail = false;

        Reporter::setCustomReporter(function () {});
        try {
            call_user_func_array(['parent', $assertionMethod], $callArgs);
        } catch (ExpectationFailedException $e) {
            $shouldFail = true;
        }

        Reporter::setCustomReporter(function () use (&$crashed) { $crashed = true; });
        try {
            call_user_func_array([$this, $assertionMethod], $callArgs);
        } catch (ExpectationFailedException $e) {
            $failed = true;
        }

        $this->assertSame($shouldCrash, $crashed, sprintf('Expect to %scrash.', $shouldCrash ? '' : 'NOT '));
        $this->assertSame($shouldFail, $failed, sprintf('Expect to %sfail.', $shouldFail ? '' : 'NOT '));
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertSameCases
     */
    public function testAssertSame($data, $expected)
    {
        $this->assertAssertionExecution('assertSame', [$expected, $data], false);
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertSameCases
     */
    public function testAssertNotSame($data, $expected)
    {
        $this->assertAssertionExecution('assertNotSame', [$expected, $data], false);
    }

    public function provideAssertSameCases()
    {
        return [
            [5, 5],
            [5, -5],
            // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
            [true, true],
            [true, false],
        ];
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertEqualsCases
     */
    public function testAssertEquals($data, $expected)
    {
        $this->assertAssertionExecution('assertEquals', [$expected, $data], true);
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertEqualsCases
     */
    public function testAssertNotEquals($data, $expected)
    {
        $this->assertAssertionExecution('assertNotEquals', [$expected, $data], true);
    }

    public function provideAssertEqualsCases()
    {
        return [
            [5, 5],
            [5, -5],
            // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
            [true, true],
            [true, false],
        ];
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeSameCases
     */
    public function testAssertAttributeSame($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeSame', [$expected, $attribute, $this], false);
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeSameCases
     */
    public function testAssertAttributeNotSame($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeNotSame', [$expected, $attribute, $this], false);
    }

    public function provideAssertAttributeSameCases()
    {
        return [
            ['fixtureAttributeBool', true],
            ['fixtureAttributeInt', 123],
            ['fixtureAttributeBool', true],
            ['fixtureAttributeInt', 123],
        ];
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeEqualsCases
     */
    public function testAssertAttributeEquals($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeEquals', [$expected, $attribute, $this], true);
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeEqualsCases
     */
    public function testAssertAttributeNotEquals($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeNotEquals', [$expected, $attribute, $this], true);
    }

    public function provideAssertAttributeEqualsCases()
    {
        return [
            ['fixtureAttributeBool', true],
            ['fixtureAttributeInt', 123],
            ['fixtureAttributeBool', true],
            ['fixtureAttributeInt', 123],
        ];
    }

    public function testAssertJsonStringEqualsJsonString()
    {
        $this->assertAssertionExecution('assertJsonStringEqualsJsonString', [
            '{"a": "b", "c": "d"}',
            '{"c": "d", "a": "b"}',
        ], false);
    }

    public function testAssertXmlStringEqualsXmlString()
    {
        $this->assertAssertionExecution('assertXmlStringEqualsXmlString', [
            '<?xml version="1.0" encoding="UTF-8"?><report></report>',
            '<?xml version="1.0" encoding="UTF-8"?>
            <report></report>',
        ], false);
    }

    public function testAssertStringEqualsFile()
    {
        $this->assertAssertionExecution('assertStringEqualsFile', [
            __FILE__,
            file_get_contents(__FILE__),
        ], false);
    }
}
