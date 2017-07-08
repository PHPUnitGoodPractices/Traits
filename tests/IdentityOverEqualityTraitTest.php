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

    public function testAssertSameWorks()
    {
        $data = 5;

        $this->assertSame($data, $data);
    }

    public function testAssertSameWorksForBooleans()
    {
        $data = true;

        // assertSame has special handling when both params are booleans and it calls `assertEquals` under the hood
        $this->assertSame($data, $data);
    }

    public function testAssertEqualsFails()
    {
        $data = 5;

        if (is_callable(array($this, 'expectException'))) {
            $this->expectException(Warning::class);
        } else {
            $this->setExpectedException(Warning::class);
        }

        $this->assertEquals($data, $data);
    }
}
