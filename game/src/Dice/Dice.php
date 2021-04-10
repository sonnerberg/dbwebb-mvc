<?php

declare(strict_types=1);

namespace Pene14\Dice;

class Dice
{
    private int $numberSides = 6;
    private int $lastRoll;

    public function __contruct(int $numberSides): void {
        $this->numberSides = $numberSides;
    }

    public function setSides(int $sides): void {
        if ($sides < 1) {
            $numberSides = $sides;
        }
        echo "Number of sides has to be 1 or more.";
    }

    public function getSides(): int {
        return $numberSides;
    }

    public function getLastRoll(): int {
        return $this->lastRoll;
    }

    public function rollDice(): int {
        $newRoll = random_int(1, $this->getSides());
        $this->lastRoll = $newRoll;
        return $newRoll;
    }
}
