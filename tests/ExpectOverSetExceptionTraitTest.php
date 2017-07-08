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
use PHPUnitGoodPractices\ExpectOverSetExceptionTrait;

/**
 * @covers \PHPUnitGoodPractices\ExpectOverSetExceptionTrait
 */
final class ExpectOverSetExceptionTraitTest extends TestCase
{
    use ExpectOverSetExceptionTrait;

    public function testAssertSameWorks()
    {
        $this->assertTrue('todo');
    }
}
