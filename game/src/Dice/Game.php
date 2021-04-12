<?php

declare(strict_types=1);

namespace Pene14\Dice;

use function Mos\Functions\{
    // destroySession,
    redirectTo,
    // renderView,
    renderTwigView,
    sendResponse,
    url
};


class Game
{
public function playGame() {

    $dice = new GraphicalDice();

    $dice->setSides(20);
    $dice->rollDice();
    // $dieHand = new DieHand(5);
    $dieHand = new DiceHand(5);
    $dieHand->rollDie();
    $data = [
        "header" => "Dice",
        "message" => "Hey,play some die!",
        "lastRoll" => $dice->getLastRoll(),
        "lastRolls" => $dieHand->getLastRolls(),
        "graphicalTest" => $dice->graphical(),
        "graphical" => $dieHand->graphicalDie(),
    ];
    $body = renderTwigView("dice.html", $data);
    sendResponse($body);
}
}
