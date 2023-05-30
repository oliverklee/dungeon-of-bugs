<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs;

class Location
{
    private int $xCoordinate;
    private int $yCoordinate;

    public function __construct(int $xCoordinate, int $yCoordinate)
    {
        if ($xCoordinate < 0) {
            throw new \InvalidArgumentException('Negative value given for X-Coordinate', 1685453188);
        }
        if ($yCoordinate < 0) {
            throw new \InvalidArgumentException('Negative value given for Y-Coordinate', 1685453041);
        }
        $this->xCoordinate = $xCoordinate;
        $this->yCoordinate = $yCoordinate;
    }

    public function getXCoordinate(): int
    {
        return $this->xCoordinate;
    }

    public function getYCoordinate(): int
    {
        return $this->yCoordinate;
    }

    public function moveDown(): void
    {
        if ($this->yCoordinate === 0) {
            throw new \RuntimeException('Can not move down any more', 1685454221);
        }

        $this->yCoordinate -= 1;
    }

    public function moveLeft(): void
    {
        if ($this->xCoordinate === 0) {
            throw new \RuntimeException('Can not move left any more', 1685454621);
        }

        $this->xCoordinate -= 1;
    }

    public function moveRight(): void
    {
        $this->xCoordinate += 1;
    }

    public function moveUp(): void
    {
        $this->yCoordinate += 1;
    }
}
