<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Tests\Unit;

use OliverKlee\DungeonOfBugs\Location;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\DungeonOfBugs\Location
 */
final class LocationTest extends TestCase
{
    /**
     * @test
     */
    public function getXCoordinateInitiallyReturnsValueSetByConstructor(): void
    {
        $xCoordinate = 1;
        $subject = new Location($xCoordinate, 100);

        self::assertSame($xCoordinate, $subject->getXCoordinate());
    }

    /**
     * @test
     */
    public function getYCoordinateInitiallyReturnsValueSetByConstructor(): void
    {
        $yCoordinate = 1;
        $subject = new Location(100, $yCoordinate);

        self::assertSame($yCoordinate, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function constructorThrowsExceptionForNegativeXCoordinate(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Negative value given for X-Coordinate');
        $this->expectExceptionCode(1685453188);

        $xCoordinate = -1;
        $subject = new Location($xCoordinate, 100);
    }

    /**
     * @test
     */
    public function constructorThrowsExceptionForNegativeYCoordinate(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Negative value given for Y-Coordinate');
        $this->expectExceptionCode(1685453041);

        $yCoordinate = -1;
        $subject = new Location(100, $yCoordinate);
    }

    /**
     * @test
     */
    public function moveDownDecrementsYCoordinateByOne(): void
    {
        $initialYCoordinate = 1;
        $subject = new Location(100, $initialYCoordinate);

        $subject->moveDown();

        $expectedYValue = $initialYCoordinate - 1;
        self::assertSame($expectedYValue, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function moveDownCalledTwiceDecrementsYCoordinateByTwo(): void
    {
        $initialYCoordinate = 2;
        $subject = new Location(100, $initialYCoordinate);

        $subject->moveDown();
        $subject->moveDown();

        $expectedYValue = $initialYCoordinate - 2;
        self::assertSame($expectedYValue, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function moveDownWithYCoordinateEqualToZeroThrowsException(): void
    {
        $initialYCoordinate = 0;
        $subject = new Location(100, $initialYCoordinate);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Can not move down any more');
        $this->expectExceptionCode(1685454221);

        $subject->moveDown();
    }

    /**
     * @test
     */
    public function moveDownKeepsXCoordinateTheSame(): void
    {
        $initialXCoordinate = 1;
        $subject = new Location($initialXCoordinate, 100);

        $subject->moveDown();

        self::assertSame($initialXCoordinate, $subject->getXCoordinate());
    }

    /**
     * @test
     */
    public function moveLeftDecrementsXCoordinateByOne(): void
    {
        $initialXCoordinate = 1;
        $subject = new Location($initialXCoordinate, 100);

        $subject->moveLeft();

        $expectedXValue = $initialXCoordinate - 1;
        self::assertSame($expectedXValue, $subject->getXCoordinate());
    }

    /**
     * @test
     */
    public function moveLeftCalledTwiceDecrementsXCoordinateByTwo(): void
    {
        $initialXCoordinate = 2;
        $subject = new Location($initialXCoordinate, 100);

        $subject->moveLeft();
        $subject->moveLeft();

        $expectedXValue = $initialXCoordinate - 2;
        self::assertSame($expectedXValue, $subject->getXCoordinate());
    }

    /**
     * @test
     */
    public function moveLeftWithXCoordinateEqualToZeroThrowsException(): void
    {
        $initialXCoordinate = 0;
        $subject = new Location($initialXCoordinate, 100);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Can not move left any more');
        $this->expectExceptionCode(1685454621);

        $subject->moveLeft();
    }

    /**
     * @test
     */
    public function moveLeftKeepsYCoordinateTheSame(): void
    {
        $initialYCoordinate = 1;
        $subject = new Location(100, $initialYCoordinate);

        $subject->moveLeft();

        self::assertSame($initialYCoordinate, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function moveRightIncrementsXCoordinateByOne(): void
    {
        $initialXCoordinate = 1;
        $subject = new Location($initialXCoordinate, 100);

        $subject->moveRight();

        $expectedXValue = $initialXCoordinate + 1;
        self::assertSame($expectedXValue, $subject->getXCoordinate());
    }

    /**
     * @test
     */
    public function moveRightCalledTwiceIncrementsXCoordinateByTwo(): void
    {
        $initialXCoordinate = 2;
        $subject = new Location($initialXCoordinate, 100);

        $subject->moveRight();
        $subject->moveRight();

        $expectedXValue = $initialXCoordinate + 2;
        self::assertSame($expectedXValue, $subject->getXCoordinate());
    }

    /**
     * @test
     */
    public function moveRightKeepsYCoordinateTheSame(): void
    {
        $initialYCoordinate = 1;
        $subject = new Location(100, $initialYCoordinate);

        $subject->moveRight();

        self::assertSame($initialYCoordinate, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function moveUpIncrementsYCoordinateByOne(): void
    {
        $initialYCoordinate = 1;
        $subject = new Location(100, $initialYCoordinate);

        $subject->moveUp();

        $expectedYValue = $initialYCoordinate + 1;
        self::assertSame($expectedYValue, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function moveUpCalledTwiceIncrementsYCoordinateByTwo(): void
    {
        $initialYCoordinate = 1;
        $subject = new Location(100, $initialYCoordinate);

        $subject->moveUp();
        $subject->moveUp();

        $expectedYValue = $initialYCoordinate + 2;
        self::assertSame($expectedYValue, $subject->getYCoordinate());
    }

    /**
     * @test
     */
    public function moveUpKeepsXCoordinateTheSame(): void
    {
        $initialXCoordinate = 1;
        $subject = new Location($initialXCoordinate, 100);

        $subject->moveUp();

        self::assertSame($initialXCoordinate, $subject->getXCoordinate());
    }
}
