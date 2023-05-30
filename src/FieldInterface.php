<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs;

interface FieldInterface {
    public function isPassable(): bool;
    public function getEmoji(): string;
}
