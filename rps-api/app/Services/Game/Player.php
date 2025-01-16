<?php

namespace App\Services\Game;

interface Player
{
    public function makeMove(): GameStrategy;

    public function getName(): string;

    public function addWin(): void;

    public function getScore(): int;
}