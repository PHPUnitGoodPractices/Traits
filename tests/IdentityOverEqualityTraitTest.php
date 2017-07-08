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

use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\IdentityOverEqualityTrait;

/**
 * @covers \PHPUnitGoodPractices\IdentityOverEqualityTrait
 */
final class IdentityOverEqualityTraitTest extends TestCase
{
    use IdentityOverEqualityTrait;

    public $fixtureAttributeBool = true;
    public $fixtureAttributeInt = 123;

    public function expectException($exception)
    {
        if (is_callable(array('parent', 'expectException'))) {
            parent::expectException($exception);
        } else {
            $this->setExpectedException($exception);
        }
    }

    public function testAssertSameWorks()
    {
        $this->assertSame(5, 5);
    }

    public function testAssertSameWorksForBooleans()
    {
        // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
        $this->assertSame(true, true);
    }

    public function testAssertEqualsFails()
    {
        $this->expectException(Warning::class);

        $this->assertEquals(5, 5);
    }

    public function testAssertNotSameWorks()
    {
        $this->assertNotSame(5, 10);
    }

    public function testAssertNotSameWorksForBooleans()
    {
        // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
        $this->assertNotSame(true, false);
    }

    public function testAssertNotEqualsFails()
    {
        $this->expectException(Warning::class);

        $this->assertNotEquals(5, 10);
    }

    public function testAssertAttributeSameWorks()
    {
        $this->assertAttributeSame(123, 'fixtureAttributeInt', $this);
    }

    public function testAssertAttributeSameWorksForBooleans()
    {
        // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
        $this->assertAttributeSame(true, 'fixtureAttributeBool', $this);
    }

    public function testAssertAttributeEqualsFails()
    {
        $this->expectException(Warning::class);

        $this->assertAttributeEquals(123, 'fixtureAttributeInt', $this);
    }

    public function testAssertAttributeNotSameWorks()
    {
        $this->assertAttributeNotSame(321, 'fixtureAttributeInt', $this);
    }

    public function testAssertAttributeNotSameWorksForBooleans()
    {
        // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
        $this->assertAttributeNotSame(false, 'fixtureAttributeBool', $this);
    }

    public function testAssertAttributeNotEqualsFails()
    {
        $this->expectException(Warning::class);

        $this->assertAttributeNotEquals(321, 'fixtureAttributeInt', $this);
    }
}
