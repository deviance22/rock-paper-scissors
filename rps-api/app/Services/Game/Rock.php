<?php
namespace App\Services\Game;

class Rock implements GameStrategy
{
    public function beats(GameStrategy $opponentMove): bool
    {
        return $opponentMove instanceof Scissors;
    }

    public function getMoveName(): string
    {
        return 'Rock';
    }
}