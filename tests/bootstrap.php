<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (
    \PHP_VERSION_ID >= 70200 && version_compare(PHPUnit\Runner\Version::id(), '4.1') < 0
) {
    die(sprintf(
        "\e[45mPHPUnit %s: Is not compatible with PHP %s.\e[0m",
        PHPUnit\Runner\Version::id(),
        PHP_VERSION
    ));
}

require __DIR__.'/../vendor/autoload.php';
