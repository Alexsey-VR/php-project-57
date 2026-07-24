<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testThatTrueIsTrue(): void
    {
        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
