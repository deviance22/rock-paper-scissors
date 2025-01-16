<?php

namespace App\Services\Game;

class MoveFactory
{
    public static function makeMove(string $move): GameStrategy
    {
        return match (strtolower($move)) {
            'rock' => new Rock(),
            'paper' => new Paper(),
            'scissors' => new Scissors(),
            default => throw new \InvalidArgumentException('Invalid move'),
        };
    }

    public static function makeRandomMove(): GameStrategy
    {
        $moves = ['rock', 'paper', 'scissors'];
        $randomMove = $moves[array_rand($moves)];

        return self::makeMove($randomMove);
    }
}