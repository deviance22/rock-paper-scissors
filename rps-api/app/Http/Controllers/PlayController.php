<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function checkWinner()
    {
        $player1Choice = request('randomChoice');
        $player2Choice = request('choice');
        $winner = $this->determineWinner($player1Choice, $player2Choice);
        return response()->json([
            'player1' => $player1Choice,
            'player2' => $player2Choice,
            'winner' => $winner
        ]);
    }

    private function determineWinner($player1Choice, $player2Choice)
    {
        if ($player1Choice === $player2Choice) {
            return 'tie';
        }

        if ($player1Choice === 'rock') {
            return $player2Choice === 'scissors' ? 'player' : 'computer';
        }

        if ($player1Choice === 'paper') {
            return $player2Choice === 'rock' ? 'player' : 'computer';
        }

        if ($player1Choice === 'scissors') {
            return $player2Choice === 'paper' ? 'player' : 'computer';
        }
    }
}
