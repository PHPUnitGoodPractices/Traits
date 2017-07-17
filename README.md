# PHPUnit Good Practices

Highly opinionated PHPUnit good practices enforcer.

## Available traits

### ExpectationViaCodeOverAnnotationTrait

Expected exception shall be set up via code, not annotations.

### IdentityOverEqualityTrait

Identity assertion (`===`) shall be used over equality ones (`==`).

### ProphecyOverMockObjectTrait

Prophecy shall be used over Mock Objects.

## Example usage

```php
<?php

namespace FooProject\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\ExpectationViaCodeOverAnnotationTrait;
use PHPUnitGoodPractices\IdentityOverEqualityTrait;
use PHPUnitGoodPractices\ProphecyOverMockObjectTrait;

final class FooTest extends TestCase
{
    use ExpectationViaCodeOverAnnotationTrait;
    use IdentityOverEqualityTrait;
    use ProphecyOverMockObjectTrait;

    public function testBar()
    {
        $this->assertEquals(123, 213); // will report non-strict assertion usage
    }
}
```
