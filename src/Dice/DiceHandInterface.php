<?php
namespace Pene14\Dice;

Interface DiceHandInterface
{
    public function rollDie(): void;

    public function getLastRolls(): string;

    public function getSumLastRolls(): int;

    public function graphicalDie(): string;
}