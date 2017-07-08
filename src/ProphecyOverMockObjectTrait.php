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

if (version_compare(PHPUnitVersionRetriever::getVersion(), '4.5') < 0) {
    trait ProphecyOverMockObjectTrait
    {
    }
} elseif (version_compare(PHPUnitVersionRetriever::getVersion(), '5.4') < 0) {
    trait ProphecyOverMockObjectTrait
    {
        public function getMockBuilder($className)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        public function getMockForAbstractClass($originalClassName, array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = array(), $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        public function getMockForTrait($traitName, array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = array(), $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockClass($originalClassName, $methods = array(), array $arguments = array(), $mockClassName = '', $callOriginalConstructor = false, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockFromWsdl($wsdlFile, $originalClassName = '', $mockClassName = '', array $methods = array(), $callOriginalConstructor = true, array $options = array())
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getObjectForTrait($traitName, array $arguments = array(), $traitClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }
    }
} elseif (version_compare(PHPUnitVersionRetriever::getVersion(), '6.0') < 0) {
    trait ProphecyOverMockObjectTrait
    {
        public function getMockBuilder($className)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockClass($originalClassName, $methods = array(), array $arguments = array(), $mockClassName = '', $callOriginalConstructor = false, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockForAbstractClass($originalClassName, array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = array(), $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockFromWsdl($wsdlFile, $originalClassName = '', $mockClassName = '', array $methods = array(), $callOriginalConstructor = true, array $options = array())
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockForTrait($traitName, array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = array(), $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getObjectForTrait($traitName, array $arguments = array(), $traitClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }
    }
} else {
    trait ProphecyOverMockObjectTrait
    {
        public function getMockBuilder($className)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockClass($originalClassName, $methods = array(), array $arguments = array(), $mockClassName = '', $callOriginalConstructor = false, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockForAbstractClass($originalClassName, array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = array(), $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockFromWsdl($wsdlFile, $originalClassName = '', $mockClassName = '', array $methods = array(), $callOriginalConstructor = true, array $options = array())
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getMockForTrait($traitName, array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = array(), $cloneArguments = false)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }

        protected function getObjectForTrait($traitName, array $arguments = array(), $traitClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true)
        {
            Reporter::report('Use `Prophecy` instead of basic `MockObject`.');

            return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
        }
    }
}
