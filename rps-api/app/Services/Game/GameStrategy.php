<?php
namespace App\Services\Game;

interface GameStrategy
{
    public function beats(GameStrategy $opponentMove): bool;

    public function getMoveName(): string;
}