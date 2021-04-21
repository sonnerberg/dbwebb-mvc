<?php

declare(strict_types=1);

namespace Pene14\Dice;

class Dice implements DiceInterface
{
    use DiceTrait;
    private ?int $lastRoll = null;
    protected int $numberSides = 6;
}
