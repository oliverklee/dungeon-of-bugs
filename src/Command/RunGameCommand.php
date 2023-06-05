<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Command;

use OliverKlee\DungeonOfBugs\Game;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Runs the game in Symfony console.
 */
#[AsCommand(name: 'game:run')]
class RunGameCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('Run the snake game in Symfony console');
        $this->addArgument('mapfile', InputArgument::OPTIONAL, 'The path to the map file.', 'maps/map-01.txt');
    }

    /**
     * @return Command::*
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // back up terminal settings
        $sttyModeBackup = \shell_exec('stty -g');

        // disable keyboard echo
        \shell_exec('stty -icanon -echo');

        $stdin = \fopen('php://stdin', 'rb');
        \assert(\is_resource($stdin));

        $cursor = new Cursor($output);
        $game = new Game($output, $cursor);
        $game->start();

        do {
            $character = fread($stdin, 1);
            \assert(\is_string($character));
            $game->processKeyInput($character);
        } while ($game->isRunning());

        // restore terminal settings
        \shell_exec(sprintf('stty %s', $sttyModeBackup));

        return Command::SUCCESS;
    }
}
