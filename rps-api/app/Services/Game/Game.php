<?php
namespace App\Services\Game;

class Game
{
    public function playRounds(array $players)
    {
        $moves = [];
        $moveNames = [];

        foreach($players as $player) {
            $move = $player->makeMove();
            $moves[$player->getName()] = $move;
        }

        $winners = $this->determineWinners($players);

        if(count($winners) === 1) {
            $winner = $winners[0];
            $winner->addWin();
            return $winner->getName();
        }
        return "draw";
    }

    private function determineWinners(array $players): array
    {
        $bestMove = null;
        $winners = [];

        foreach ($players as $player) {
            $move = $player->makeMove();

            if (!$bestMove || $move->beats($bestMove)) {
                $bestMove = $move;
                $winners = [$player];  // Reset winners list with the new best player
            } elseif ($bestMove && $bestMove->beats($move)) {
                continue;  // Best move remains unchanged
            } elseif ($bestMove && !$move->beats($bestMove)) {
                $winners[] = $player;  // Add to winners if it's a tie
            }
        }

        return $winners;
    }

    public function getScores(array $players): string
    {
        $scores = array_map(fn($player) => "{$player->getName()} Score: {$player->getScore()}", $players);
        return implode(' | ', $scores);
    }
}