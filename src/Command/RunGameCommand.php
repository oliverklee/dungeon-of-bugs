<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Command;

use OliverKlee\DungeonOfBugs\GameBuilder;
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
        $mapFile = $input->getArgument('mapfile');
        \assert(\is_string($mapFile));

        // back up terminal settings
        $sttyModeBackup = \shell_exec('stty -g');
        // disable keyboard echo
        \shell_exec('stty -icanon -echo');

        $cursor = new Cursor($output);
        $cursor->hide();
        $cursor->clearScreen();

        $cursor->moveToPosition(1, 1);
        $output->writeln('Hello World!');
        $output->writeln('Map to load: ' . $mapFile);
        $output->writeln('Press ESC to exit.');

        $gameBuilder = new GameBuilder();
        $world = $gameBuilder->loadGameWorld($mapFile);
        $game = $gameBuilder->buildGame($world, $input, $output);
        $cursor->moveToPosition(1, 10);

        $stdin = \fopen('php://stdin', 'rb');
        \assert(\is_resource($stdin));
        $output->writeln('Here we will see the game world.');
        $output->writeln('It will have multiple lines');

        do {
            $character = fread($stdin, 1);
            \assert(\is_string($character));
            $output->writeln('You pressed "' . $character . '" with ASCII code: ' . ord($character));
        } while ($character !== chr(27));

        $cursor->show();

        // restore terminal settings
        \shell_exec(sprintf('stty %s', $sttyModeBackup));

        return Command::SUCCESS;
    }
}
