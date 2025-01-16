<?php

namespace App\Services\Game;

class HumanPlayer implements Player
{
    private string $name;
    private int $score = 0;
    private GameStrategy $move;

    public function __construct(string $name = 'Human', GameStrategy $move)
    {
        $this->name = $name;
        $this->move = $move;
    }

    public function makeMove(): GameStrategy
    {
        return $this->move;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addWin(): void
    {
        $this->score++;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}