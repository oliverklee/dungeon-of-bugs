<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs;

class Wall implements FieldInterface {

    public function isPassable(): bool
    {
        return false;
    }

    public function getEmoji(): string
    {
        return '🧱';
    }
}
