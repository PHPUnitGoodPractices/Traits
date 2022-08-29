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

/**
 * @coversNothing
 *
 * @internal
 */
final class AutoReviewTest extends TestCase
{
    public function testThatThereIsProperPHPUnitInComposer()
    {
        $requirements = file_get_contents(__DIR__.'/../composer.json');
        $requirements = json_decode($requirements, true)['require']['phpunit/phpunit'];

        $yml = file_get_contents(__DIR__.'/../.github/workflows/ci.yml');

        preg_match_all('/phpunit-version: (\S+)/', $yml, $matches);

        $testedVersions = array_unique($matches[1]);

        foreach (explode(' || ', $requirements) as $version) {
            preg_match('/^[\^~](\d+)\.\d+(?:\.\d+)?$/', $version, $match);

            self::assertContains(
                $majorVersion = $match[1],
                $testedVersions,
                "PHPUnit {$majorVersion} is allowed in composer.json, but not present in the test matrix at .github/workflows/ci.yml."
            );
        }
    }
}
