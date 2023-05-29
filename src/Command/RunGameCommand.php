<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StreamableInputInterface;
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
        $this->addArgument('levelfile', InputArgument::OPTIONAL, 'The path to the level file.', 'levels/level-01.txt');
    }

    /**
     * @return Command::*
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input instanceof StreamableInputInterface && \is_resource($input->getStream())) {
            $inputStream = $input->getStream();
        } else {
            $inputStream = STDIN;
        }

        \stream_set_blocking($inputStream, false);
        $sttyMode = \shell_exec('stty -g');
        \shell_exec('stty -icanon -echo');

        $cursor = new Cursor($output);
        $cursor->hide();

        $output->writeln('Hello World!');
        $output->writeln('Level to load: ' . $input->getArgument('levelfile'));

        $cursor->show();
        \stream_set_blocking($inputStream, true);
        \shell_exec(sprintf('stty %s', $sttyMode));

        return Command::SUCCESS;
    }
}
