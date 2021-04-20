<?php

declare(strict_types=1);

namespace Pene14\Dice;

class Dice
{
    private $lastRoll = null;
    protected $numberSides = 6;

    public function setSides(int $sides): void {
        if ($sides < 1) {
            echo "Number of sides has to be 1 or more.";
            return;
        }
        $this->numberSides = $sides;
    }

    public function getSides(): int  {
        return $this->numberSides;
    }

    public function getLastRoll(): ?int {
        return $this->lastRoll;
    }

    public function rollDice(): int {
        $newRoll = random_int(1, $this->numberSides);
        $this->lastRoll = $newRoll;
        return $newRoll;
    }
}
