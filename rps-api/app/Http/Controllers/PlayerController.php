<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Game\GameStrategy;
use App\Services\Game\Game;
use App\Services\Game\MoveFactory;
use App\Services\Game\HumanPlayer;

class PlayerController extends Controller
{
    public function determineWinner()
    {
        $player1Choice = MoveFactory::makeRandomMove();
        $player2Choice = MoveFactory::makeMove(request('choice'));

        $player1 = new HumanPlayer('Player 1', $player1Choice);
        $player2 = new HumanPlayer('Player 2', $player2Choice);

        $game = new Game();

        $result = $game->playRounds([$player1, $player2]);
        return response()->json([
            'player1' => $player1Choice->getMoveName(),
            'winner' => $result,
        ]);
    }
}
