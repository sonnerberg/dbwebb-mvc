<?php

declare(strict_types=1);

namespace Pene14\Yatzy;

use Pene14\Dice\DiceInterface;
use Pene14\Dice\DiceTrait;
use Pene14\Dice\GraphicalDiceInterface;
use Pene14\Dice\GraphicalDiceTrait;

class YatzyDice implements DiceInterface, GraphicalDiceInterface {
    use DiceTrait;
    use GraphicalDiceTrait;
    private int $numberSides = 6;
    private ?int $lastRoll = null;
    private bool $saved = false;

    public function setSides(int $sides): void {
        $this->numberSides = self::$NUMBERSIDES;
    }

    public function toggleSave(): void {
        $this->saved = !$this->saved;
    }

    /**
     * @return bool
     */
    public function isSaved(): bool
    {
        return $this->saved;
    }
}
