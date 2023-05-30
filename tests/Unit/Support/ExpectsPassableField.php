<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Tests\Unit\Support;

use OliverKlee\DungeonOfBugs\FieldInterface;
use PHPUnit\Framework\TestCase;

/**
 * @property FieldInterface $subject
 * @mixin TestCase
 */
trait ExpectsPassableField {

    /**
     * @test
     */
    public function fieldIsPassable(): void
    {
        self::assertTrue($this->subject->isPassable());
    }
}

