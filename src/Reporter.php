<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices;

final class Reporter
{
    private static $reporter = null;

    private static $useHeader = true;

    private function __construct()
    {
    }

    public static function setReporter($reporter)
    {
        self::$reporter = $reporter;
    }

    public static function useHeader($use)
    {
        self::$useHeader = $use;
    }

    public static function report($issue)
    {
        if (self::$useHeader) {
            $issue = "PHPUnit good practice has been abused.\n$issue";
        }

        if (null === self::$reporter) {
            self::$reporter = function ($issue) { trigger_error($issue, E_USER_WARNING); };
        }

        $reporter = self::$reporter;
        $reporter($issue);
    }
}
