<?php

declare(strict_types=1);

namespace Pene14\Dice;

Interface DiceInterface {
    public function setSides(int $sides): void;

    public function getSides(): int;

    public function getLastRoll(): ?int;

    public function rollDice(): int;
}
