<?php

declare(strict_types=1);

/*
 * This file is part of PHPUnit Good Practices.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PHPUnitGoodPractices\Traits;

trait ProphecyOverMockObjectTrait9
{
    public function getMockBuilder($className): \PHPUnit\Framework\MockObject\MockBuilder
    {
        Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }

    protected function getMockClass($originalClassName, $methods = [], array $arguments = [], $mockClassName = '', $callOriginalConstructor = false, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false): string
    {
        Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }

    protected function getMockForAbstractClass($originalClassName, array $arguments = [], $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = [], $cloneArguments = false): \PHPUnit\Framework\MockObject\MockObject
    {
        Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }

    protected function getMockFromWsdl($wsdlFile, $originalClassName = '', $mockClassName = '', array $methods = [], $callOriginalConstructor = true, array $options = []): \PHPUnit\Framework\MockObject\MockObject
    {
        Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }

    protected function ggetMockForTrait($traitName, array $arguments = [], $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = [], $cloneArguments = false): \PHPUnit\Framework\MockObject\MockObject
    {
        Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }

    protected function getObjectForTrait($traitName, array $arguments = [], $traitClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true): object
    {
        Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

        return \call_user_func_array(['parent', __FUNCTION__], \func_get_args());
    }
}
