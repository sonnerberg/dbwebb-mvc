<?php

declare(strict_types=1);

namespace Pene14\Dice;

class DiceHand implements DiceHandInterface
{
    use DiceHandTrait;
    /**
     * @var GraphicalDice[]
     */
    private array $die;

    public function __construct($numberDie = 3) {
        for ($i = 0; $i < $numberDie; $i++) {
            $this->die[$i] = new GraphicalDice();
        }
    }

}
