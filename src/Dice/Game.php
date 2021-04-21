<?php

declare(strict_types=1);

namespace Pene14\Dice;

use function Mos\Functions\{
    renderTwigView,
    sendResponse
};


class Game
{
    public function playGame(): array {
        $dice = new GraphicalDice();

        $dice->setSides(20);
        $dice->rollDice();
        $dieHand = new DiceHand(5);
        $dieHand->rollDie();
        return [
            "header" => "Dice",
            "message" => "Hey,play some die!",
            "lastRoll" => $dice->getLastRoll(),
            "lastRolls" => $dieHand->getLastRolls(),
            "graphicalTest" => $dice->graphical(),
            "graphical" => $dieHand->graphicalDie(),
        ];
    }
}
