<?php

declare(strict_types=1);

namespace OliverKlee\DungeonOfBugs\Tests\Unit;

use OliverKlee\DungeonOfBugs\Game;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @covers \OliverKlee\DungeonOfBugs\Game
 */
final class GameTest extends TestCase
{
    private Game $subject;
    private OutputInterface&MockObject $outputMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->outputMock = $this->createMock(OutputInterface::class);
        $cursor = new Cursor($this->outputMock);
        $this->subject = new Game($this->outputMock, $cursor);
    }

    /**
     * @test
     */
    public function isRunningInitiallyReturnsTrue(): void
    {
        self::assertTrue($this->subject->isRunning());
    }

    /**
     * @test
     * @dataProvider keyInputProvider
     */
    public function isRunningAfterUserPressedAnyKeyExceptXReturnsTrue(string $key): void
    {
        $this->subject->processKeyInput($key);

        self::assertTrue($this->subject->isRunning());
    }

    /**
     * @test
     */
    public function isRunningAfterUserPressedXReturnsFalse(): void
    {
        $this->subject->processKeyInput('x');

        self::assertFalse($this->subject->isRunning());
    }

    /**
     * @test
     */
    public function startOutputsWelcomeMessage(): void
    {
        $this->outputMock
            ->expects(self::once())
            ->method('writeln')
            ->with(
                <<<TEXT
                    Welcome to Dungeon of Bugs!

                    Use W, A, S, D to navigate through the map.
                    Use X to exit the game.

                    Press any key to start
                    TEXT,
            );

        $this->subject->start();
    }

    /**
     * @test
     */
    public function startClearsScreen(): void
    {
        $outputMessages = [];
        $this->outputMock
            ->method('write')
            ->willReturnCallback(function (string $message) use (&$outputMessages): void {
                $outputMessages[] = $message;
            });

        $this->subject->start();

        // clear screen
        self::assertContains("\x1b[2J", $outputMessages);
        $expectedCol = 1;
        $expectedRow = 0;
        self::assertContains(sprintf("\x1b[%d;%dH", $expectedRow + 1, $expectedCol), $outputMessages);
    }

    /**
     * @test
     */
    public function gameAfterUserPressedXOutputsByeMessage(): void
    {
        $this->outputMock
            ->expects(self::once())
            ->method('writeln')
            ->with('Thank you for playing Dungeon of Bugs!');

        $this->subject->processKeyInput('x');
    }

    /**
     * @test
     * @dataProvider keyInputProvider
     */
    public function gameAfterUserPressedAnyKeyExceptCharXOutputsMap(string $key): void
    {
        $this->outputMock
            ->expects(self::once())
            ->method('writeln')
            ->with('(This is the placeholder for the game map.)');

        $this->subject->processKeyInput($key);
    }

    /**
     * @test
     */
    public function inMapViewAfterUserPressedXOutputsByeMessage(): void
    {
        $outputMessages = [];
        $this->outputMock
            ->method('writeln')
            ->willReturnCallback(function (string $message) use (&$outputMessages): void {
                $outputMessages[] = $message;
            });

        $this->subject->processKeyInput('A');
        $this->subject->processKeyInput('x');

        self::assertSame('Thank you for playing Dungeon of Bugs!', array_pop($outputMessages));
    }

    /**
     * @return array<string, list{0: non-empty-string}>
     */
    public static function keyInputProvider(): array
    {
        return [
            'any letter' => ['A'],
            'number' => ['1'],
            'enter' => ["\r"],
            'space' => [' '],
        ];
    }

    /**
     * @test
     */
    public function processKeyInputClearsScreenBeforeOutput(): void
    {
        $outputMessages = [];
        $this->outputMock
            ->method('write')
            ->willReturnCallback(function (string $message) use (&$outputMessages): void {
                $outputMessages[] = $message;
            });

        $this->subject->processKeyInput('A');

        // clear screen
        self::assertContains("\x1b[2J", $outputMessages);
        $expectedCol = 1;
        $expectedRow = 0;
        self::assertContains(sprintf("\x1b[%d;%dH", $expectedRow + 1, $expectedCol), $outputMessages);
    }
}
