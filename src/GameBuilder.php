<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameBuilder
{
    public function loadGameWorld(string $filename): GameWorld
    {
        $world = new GameWorld();

        return $world;
    }

    public function buildGame(GameWorld $world, InputInterface $input, OutputInterface $output): Game
    {
        $game = new Game();

        return $game;
    }
}
