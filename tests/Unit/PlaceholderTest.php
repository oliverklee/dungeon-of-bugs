<?php

declare(strict_types=1);

namespace Unit;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
final class PlaceholderTest extends TestCase
{
    /**
     * @test
     */
    public function universeIsStillOkay(): void
    {
        self::assertSame(2, 1 + 1);
    }
}
