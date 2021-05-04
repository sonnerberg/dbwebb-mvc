<?php

declare(strict_types=1);

namespace Pene14\Yatzy;

use Pene14\Dice\DiceHandInterface;
use Pene14\Dice\DiceHandTrait;

class YatzyDiceHand implements DiceHandInterface
{
    use DiceHandTrait;
    /**
     * @var YatzyDice[]
     */
    private array $die;
    private int $throwsLeft = 3;
    private int $numberDie = 5;

    public function __construct() {
        for ($i = 0; $i < $this->numberDie; $i++) {
            $this->die[$i] = new YatzyDice();
        }
    }

    /**
     * @return int
     */
    public function getThrowsLeft(): int
    {
        return $this->throwsLeft;
    }

    /**
     * @return int
     */
    public function getNumberDie(): int
    {
        return $this->numberDie;
    }

    public function rollDie(): void {
        if ($this->throwsLeft) {
            foreach (array_values($this->die) as $dice) {
                if (!$dice->isSaved()) {
                    $dice->rollDice();
                }
            }
            $this->throwsLeft--;
        }
    }

    public function saveDice($diceIndex): void {
        foreach ($this->die as $index => $dice) {
            if ($diceIndex === $index) {
                $dice->toggleSave();
            }
        }
    }

    public function dieStatus(): array {
        $dieStatus = array();

        foreach (array_values($this->die) as $dice) {
                $dieStatus[] = $dice->isSaved();
        }

        return $dieStatus;
    }

    public function getDie(): array {
        $die = array();

        foreach (array_values($this->die) as $dice) {
            $die[] = $dice;
        }

        return $die;
    }
}
