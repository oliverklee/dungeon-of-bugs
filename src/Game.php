<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class Game
{
    private Cursor $cursor;
    private OutputInterface $output;
    private bool $running = true;

    public function __construct(OutputInterface $output, Cursor $cursor)
    {
        $this->output = $output;
        $this->cursor = $cursor;
    }

    public function isRunning(): bool
    {
        return $this->running;
    }

    public function processKeyInput(string $key): void
    {
        $this->clearAndMoveToTopLeft();
        if ($key === 'x') {
            $this->running = false;
            $this->output->writeln('Thank you for playing Dungeon of Bugs!');
        } else {
            $this->output->writeln('(This is the placeholder for the game map.)');
        }
    }

    public function start(): void
    {
        $this->clearAndMoveToTopLeft();
        $this->output->writeln(
            <<<TEXT
Welcome to Dungeon of Bugs!

Use W, A, S, D to navigate through the map.
Use X to exit the game.

Press any key to start
TEXT
        );
    }

    protected function clearAndMoveToTopLeft(): void
    {
        $this->cursor->clearScreen();
        $this->cursor->moveToPosition(1, 0);
    }
}
