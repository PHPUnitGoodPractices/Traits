# PHPUnit Good Practices

Highly opinionated PHPUnit good practices enforcer.

## Available traits

### IdentityOverEqualityTrait

Identity assertion (`===`) shall be used over equality ones (`==`).

## Example usage

```php
<?php

namespace FooProject\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnitGoodPractices\IdentityOverEqualityTrait;

final class FooTest extends TestCase
{
    use IdentityOverEqualityTrait;

    public function testBar()
    {
        $this->assertEquals(123, 213); // will report non-strict assertion usage
    }
}
```
