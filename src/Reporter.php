<?php

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices\Traits;

use Closure;

final class Reporter
{
    /**
     * @var ?\Closure
     */
    private static $customReporter;

    /**
     * @var \Closure
     */
    private static $defaultReporter;

    /**
     * @var bool
     */
    private static $useHeader = true;

    /**
     * @param $reporter Closure
     */
    public static function setCustomReporter(\Closure $reporter)
    {
        self::$customReporter = $reporter;
    }

    public static function clearCustomReporter()
    {
        self::$customReporter = null;
    }

    /**
     * @param $use bool
     */
    public static function useHeader($use)
    {
        self::$useHeader = $use;
    }

    /**
     * @param $issue string
     */
    public static function report($issue)
    {
        if (self::$useHeader) {
            $issue = "PHPUnit good practice has been violated.\n{$issue}";
        }

        $reporter = self::$customReporter ?: self::getDefaultReporter();
        $reporter($issue);
    }

    /**
     * @return \Closure
     */
    private static function getDefaultReporter()
    {
        if (null === self::$defaultReporter) {
            self::$defaultReporter = function ($issue) { trigger_error($issue, E_USER_WARNING); };
        }

        return self::$defaultReporter;
    }
}
