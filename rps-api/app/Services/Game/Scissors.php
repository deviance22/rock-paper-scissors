<?php
namespace App\Services\Game;

class Scissors implements GameStrategy
{
    public function beats(GameStrategy $opponentMove): bool
    {
        return $opponentMove instanceof Paper;
    }

    public function getMoveName(): string
    {
        return 'Scissors';
    }
}