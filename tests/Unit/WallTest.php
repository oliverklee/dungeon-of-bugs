<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Tests\Unit;

use OliverKlee\DungeonOfBugs\FieldInterface;
use OliverKlee\DungeonOfBugs\Tests\Unit\Support\ExpectsNonPassableField;
use OliverKlee\DungeonOfBugs\Wall;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\DungeonOfBugs\Wall
 */
final class WallTest extends TestCase
{
    use ExpectsNonPassableField;

    protected Wall $subject;

    protected function setUp(): void
    {
        $this->subject = new Wall();
    }

    /**
     * @test
     */
    public function implementsField(): void
    {
        self::assertInstanceOf(FieldInterface::class, $this->subject);
    }

    /**
     * @test
     */
    public function rendersAsBricksEmoji(): void
    {
        self::assertSame('🧱', $this->subject->getEmoji());
    }
}
