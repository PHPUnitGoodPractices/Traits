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

/**
 * @coversNothing
 */
final class AutoReviewTest extends TestCase
{
    public function testThatThereIsProperPHPUnitInComposer()
    {
        $json = json_decode(file_get_contents(__DIR__.'/../composer.json'), true);
        $yaml = file_get_contents(__DIR__.'/../.travis.yml', FILE_IGNORE_NEW_LINES);
        preg_match_all('/run-tests\.sh (\S+)/', $yaml, $matches);

        $this->assertSame(
            implode(' || ', $matches[1]),
            $json['require']['phpunit/phpunit']
        );
    }
}
