<?php

namespace App\Services\Game;

class Paper implements GameStrategy
{
    public function beats(GameStrategy $opponentMove): bool
    {
        return $opponentMove instanceof Rock;
    }

    public function getMoveName(): string
    {
        return 'Paper';
    }
}