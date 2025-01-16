# Getting started with Rock-Paper-Scissors

This is a simple 2 player rock paper scissors game where player 1 is given a random choice of rock, paper or scissors and player 2 can choose whichever they want to play. The winner is decided based on the following rules:

- Rock beats scissors
- Scissors beats paper
- Paper beats rock

The game ends after 10 rounds. Scores are displayed below along with their winning percentage, and draw scores and percentage.

To run the game, use the command (this is assuming you have Docker installed):

Create an .env file in the root directory with the values found in .env.example file.

```
cd path/to/rock-paper-scissors

docker-compose build

docker-compose up -d
```

The game will be available at http://localhost:3000

Once running, generate a new key by running the following command:

`docker exec -it rock-paper-scissors-api-1 php artisan key:generate --show`

Copy the generated key and replace the existing APP_KEY in the .env.docker file.

Then redo the build and up commands.

```
docker-compose build

docker-compose up -d
```

# Playing the game

To play the game, player 2 has to simply choose between "rock, paper or scissors" then the result and score will already be displayed. When the game ends, the choices will be disabled and would just need to refresh the page to start a new game.

# Considerations when creating the game

- The game is designed to be played in a private environment, so there is no authentication or user management.
- For the backend, I've used a design pattern called 'Strategic Design Pattern' which is a combination of the Strategy and Factory design patterns. This is to make the code more modular and easier to test.
- When we need to add a new choice, we simply create a new class that implements the GameStrategy interface. You can save it in the Services/Game folder and add it to the MoveFactory.
- When adding a new choice, we only need to update any choices that it affects in the beats() method.
- There's also an option to add new players, however, I wasn't able to fully implement the dynamic nature of the game. I've added a Player interface that handles the type of player. For now, human players are only implemented. And only 2 players are allowed.
- If I could've done better, I would have it dyanmic when asking for the number of rounds to play, number of players and what choices are available. This would make the game more flexible and easier to maintain.

```

```
