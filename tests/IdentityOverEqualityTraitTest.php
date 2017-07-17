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
use PHPUnitGoodPractices\IdentityOverEqualityTrait;
use PHPUnitGoodPractices\Reporter;

/**
 * @covers \PHPUnitGoodPractices\IdentityOverEqualityTrait
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
            parent::$assertionMethod(...$callArgs);
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
            $shouldFail = true;
        }

        Reporter::setCustomReporter(function () use (&$crashed) { $crashed = true; });
        try {
            $this->$assertionMethod(...$callArgs);
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
            $failed = true;
        }

        $this->assertSame($shouldCrash, $crashed, 'Shall crash.');
        $this->assertSame($shouldFail, $failed, 'Shall fail.');
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertSameCases
     */
    public function testAssertSame($data, $expected)
    {
        $this->assertAssertionExecution('assertSame', array($expected, $data), false);
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertSameCases
     */
    public function testAssertNotSame($data, $expected)
    {
        $this->assertAssertionExecution('assertNotSame', array($expected, $data), false);
    }

    public function provideAssertSameCases()
    {
        return array(
            array(5, 5),
            array(5, -5),
            // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
            array(true, true),
            array(true, false),
        );
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertEqualsCases
     */
    public function testAssertEquals($data, $expected)
    {
        $this->assertAssertionExecution('assertEquals', array($expected, $data), true);
    }

    /**
     * @param mixed $data
     * @param mixed $expected
     *
     * @dataProvider provideAssertEqualsCases
     */
    public function testAssertNotEquals($data, $expected)
    {
        $this->assertAssertionExecution('assertNotEquals', array($expected, $data), true);
    }

    public function provideAssertEqualsCases()
    {
        return array(
            array(5, 5),
            array(5, -5),
            // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
            array(true, true),
            array(true, false),
        );
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeSameCases
     */
    public function testAssertAttributeSame($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeSame', array($expected, $attribute, $this), false);
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeSameCases
     */
    public function testAssertAttributeNotSame($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeNotSame', array($expected, $attribute, $this), false);
    }

    public function provideAssertAttributeSameCases()
    {
        return array(
            array('fixtureAttributeBool', true),
            array('fixtureAttributeInt', 123),
            array('fixtureAttributeBool', true),
            array('fixtureAttributeInt', 123),
        );
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeEqualsCases
     */
    public function testAssertAttributeEquals($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeEquals', array($expected, $attribute, $this), true);
    }

    /**
     * @param string $attribute
     * @param mixed  $expected
     *
     * @dataProvider provideAssertAttributeEqualsCases
     */
    public function testAssertAttributeNotEquals($attribute, $expected)
    {
        $this->assertAssertionExecution('assertAttributeNotEquals', array($expected, $attribute, $this), true);
    }

    public function provideAssertAttributeEqualsCases()
    {
        return array(
            array('fixtureAttributeBool', true),
            array('fixtureAttributeInt', 123),
            array('fixtureAttributeBool', true),
            array('fixtureAttributeInt', 123),
        );
    }
}
