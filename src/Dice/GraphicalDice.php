<?php

declare(strict_types=1);

namespace Pene14\Dice;

class GraphicalDice implements DiceInterface {
    use DiceTrait;
    use GraphicalDiceTrait;
    private int $numberSides = 6;
    public function setSides(int $sides): void {
        $this->numberSides = self::$NUMBERSIDES;
    }
}
