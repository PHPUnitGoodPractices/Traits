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

if (version_compare(PHPUnitVersionRetriever::getVersion(), '6.0') >= 0) {
    trait ExpectOverSetExceptionTrait
    {
    }
} else {
    trait ExpectOverSetExceptionTrait
    {
        public function setExpectedException($exception, $message = '', $code = null)
        {
            if (null === $exception) {
                Reporter::report('Do not pass `null` as expected exception, it violates official interface of method, removes expectation if it is the only parameter or downgrade it to raw Exception if there are more parameters, and will crash on newer `expectException*` method.');
            } elseif (version_compare(PHPUnitVersionRetriever::getVersion(), '5.2') >= 0) {
                Reporter::report('Use `->expectExeption*()` methods instead of `->setExpectedException()`.');
            }

            call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        public function setExpectedExceptionRegExp($exception, $message = '', $code = null)
        {
            if (null === $exception) {
                Reporter::report('Do not pass `null` as expected exception, it violates official interface of method, removes expectation if it is the only parameter or downgrade it to raw Exception if there are more parameters, and will crash on newer `expectException*` method.');
            } elseif (version_compare(PHPUnitVersionRetriever::getVersion(), '5.2') >= 0) {
                Reporter::report('Use `->expectExeption*()` methods instead of `->setExpectedExceptionRegExp()`.');
            }

            call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }
    }
}
