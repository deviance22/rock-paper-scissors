import React, { useState } from "react";
import "./App.css";
import axios from "axios";

axios.defaults.withCredentials = true;

function App() {
  const [round, setRound] = useState(1);
  const [player1Choice, setPlayer1Choice] = useState(null);
  const [player2Choice, setPlayer2Choice] = useState(null);

  const [result, setResult] = useState(null);

  const [player1Score, setPlayer1Score] = useState(0);
  const [player2Score, setPlayer2Score] = useState(0);

  const [player1WinPercentage, setPlayer1WinPercentage] = useState(0);
  const [player2WinPercentage, setPlayer2WinPercentage] = useState(0);
  const [drawPercentage, setDrawPercentage] = useState(0);

  const [gameDone, setGameDone] = useState(false);

  const [drawScore, setDrawScore] = useState(0);
  const backendUrl = process.env.REACT_APP_BACKEND_URL;

  const choices = ["Rock", "Paper", "Scissors"];

  const handlePlayer2Choice = (choice) => {
    setPlayer2Choice(choice);
    determineWinner(choice);
  };

  const determineWinner = async (player2) => {
    if (!player2) return;

    await axios
      .post(
        backendUrl + "determineWinner",
        JSON.stringify({
          choice: player2,
          player1Score,
          player2Score,
          drawScore,
        }),
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      )
      .then((response) => {
        const { player1, winner } = response.data;
        setPlayer1Choice(player1);
        setResult(winner);
        updateScore(winner);
      });

    if (round < 10) {
      setRound(round + 1);
    } else {
      setGameDone(true);
    }
  };

  const updateScore = (winner) => {
    if (winner === "Player 1") {
      setPlayer1Score(player1Score + 1);
      const winningPercentage = ((player1Score + 1) / round) * 100;
      setPlayer1WinPercentage(winningPercentage.toFixed(2));
      setPlayer2WinPercentage(((player2Score / round) * 100).toFixed(2));
      setDrawPercentage(((drawScore / round) * 100).toFixed(2));
    } else if (winner === "Player 2") {
      setPlayer2Score(player2Score + 1);
      const winningPercentage = ((player2Score + 1) / round) * 100;
      setPlayer2WinPercentage(winningPercentage.toFixed(2));
      setPlayer1WinPercentage(((player1Score / round) * 100).toFixed(2));
      setDrawPercentage(((drawScore / round) * 100).toFixed(2));
    } else {
      setDrawScore(drawScore + 1);
      const drawPercentage = ((drawScore + 1) / round) * 100;
      setDrawPercentage(drawPercentage.toFixed(2));
      setPlayer1WinPercentage(((player1Score / round) * 100).toFixed(2));
      setPlayer2WinPercentage(((player2Score / round) * 100).toFixed(2));
    }
  };

  return (
    <div className="App">
      <header className="App-header">
        <h1>Rock, Paper, Scissors</h1>
        <p>Round: {round}</p>
        <div>
          <div>
            {player1Choice ? (
              <p>Player 1: {player1Choice}</p>
            ) : (
              <p>Player 1: ?</p>
            )}
          </div>
        </div>
        <div>
          <h3>Player 2 Choose:</h3>
          {choices.map((choice) => (
            <button
              key={choice}
              onClick={() => handlePlayer2Choice(choice)}
              disabled={gameDone}
            >
              {choice}
            </button>
          ))}
          <div>
            {player2Choice ? (
              <p>Player 2: {player2Choice}</p>
            ) : (
              <p>Player 2: ?</p>
            )}
          </div>
        </div>
        <div>{result && <p>Result: {result}</p>}</div>
        <div>
          <h3>Score:</h3>
          <p>
            Player 1: {player1Score} Win Percentage: {player1WinPercentage}%
          </p>
          <p>
            Player 2: {player2Score} Win Percentage: {player2WinPercentage}%
          </p>
          <p>
            Draw: {drawScore} Draw Percentage: {drawPercentage}%
          </p>
        </div>
      </header>
    </div>
  );
}

export default App;
