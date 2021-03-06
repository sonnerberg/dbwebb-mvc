<?php


declare(strict_types=1);

namespace Pene14\Dice;

trait DiceHandTrait
{
    public function rollDie(): void {
        foreach (array_values($this->die) as $dice) {
            $dice->rollDice();
        }
    }

    public function getLastRolls(): string {
        $items = array();

        foreach (array_values($this->die) as $dice) {
            $items[] = $dice->getLastRoll();
        }
        return implode(',', $items) . ' = ' . array_sum($items);
    }

    public function getSumLastRolls(): int {
        $items = array();

        foreach (array_values($this->die) as $dice) {
            $items[] = $dice->getLastRoll();
        }
        return array_sum($items);
    }

    public function graphicalDie(): string {
        $items = array();

        foreach (array_values($this->die) as $dice) {
            $items[] = $dice->graphical();
        }

        return implode("", $items) ;
    }

}
