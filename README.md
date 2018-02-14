# PHPUnit Good Practices

Highly opinionated PHPUnit good practices enforcer.

## Available traits

### ExpectationViaCodeOverAnnotationTrait

Expected exception shall be set up via code, not annotations.

### ExpectOverSetExceptionTrait

Expectation shall be set directly over via setter.

### IdentityOverEqualityTrait

Identity assertion (`===`) shall be used over equality ones (`==`).

### ProphecyOverMockObjectTrait

Prophecy shall be used over Mock Objects.

### ProphesizeOnlyInterfaceTrait

Prophecy shall be created only for (existing) interfaces.

## Example usage

```php
<?php

namespace FooProject\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\Traits\ExpectationViaCodeOverAnnotationTrait;
use PHPUnitGoodPractices\Traits\ExpectOverSetExceptionTrait;
use PHPUnitGoodPractices\Traits\IdentityOverEqualityTrait;
use PHPUnitGoodPractices\Traits\ProphecyOverMockObjectTrait;
use PHPUnitGoodPractices\Traits\ProphesizeOnlyInterfaceTrait;

final class FooTest extends TestCase
{
    use ExpectationViaCodeOverAnnotationTrait;
    use ExpectOverSetExceptionTrait;
    use IdentityOverEqualityTrait;
    use ProphecyOverMockObjectTrait;
    use ProphesizeOnlyInterfaceTrait;

    public function testBar()
    {
        $this->assertEquals(123, 213); // will report non-strict assertion usage
    }
}
```
