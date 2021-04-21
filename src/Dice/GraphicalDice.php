<?php

declare(strict_types=1);

namespace Pene14\Dice;

class GraphicalDice implements DiceInterface {
    use DiceTrait;
    private int $numberSides = 6;
    public function setSides(int $sides): void {
        $this->numberSides = self::$NUMBERSIDES;
    }

    public function graphical(): string {
        $lastRoll = $this->getLastRoll();
        $diceRolls = array();
        $diceRolls[1] = '<div style="background: black; grid-area: center; border-radius: 50%;"></div>';
        $diceRolls[2] = '<div style="background: black; grid-area: upper-left; border-radius: 50%;"></div>
               <div style="background: black; grid-area: lower-right; border-radius: 50%;"></div>';
        $diceRolls[3] = '<div style="background: black; grid-area: upper-left; border-radius: 50%;"></div>
                <div style="background: black; grid-area: center; border-radius: 50%;"></div>
               <div style="background: black; grid-area: lower-right; border-radius: 50%;"></div>';
        $diceRolls[4] = '<div style="background: black; grid-area: upper-left; border-radius: 50%;"></div>
                <div style="background: black; grid-area: upper-right; border-radius: 50%;"></div>
                <div style="background: black; grid-area: lower-left; border-radius: 50%;"></div>
               <div style="background: black; grid-area: lower-right; border-radius: 50%;"></div>';
        $diceRolls[5] = '<div style="background: black; grid-area: upper-left; border-radius: 50%;"></div>
                <div style="background: black; grid-area: upper-right; border-radius: 50%;"></div>
                <div style="background: black; grid-area: center; border-radius: 50%;"></div>
                <div style="background: black; grid-area: lower-left; border-radius: 50%;"></div>
               <div style="background: black; grid-area: lower-right; border-radius: 50%;"></div>';
        $diceRolls[6] = '<div style="background: black; grid-area: upper-left; border-radius: 50%;"></div>
                <div style="background: black; grid-area: upper-right; border-radius: 50%;"></div>
                <div style="background: black; grid-area: center-left; border-radius: 50%;"></div>
                <div style="background: black; grid-area: center-right; border-radius: 50%;"></div>
                <div style="background: black; grid-area: lower-left; border-radius: 50%;"></div>
               <div style="background: black; grid-area: lower-right; border-radius: 50%;"></div>';
        $rolledNumber = $diceRolls["$lastRoll"];
        return <<<EOT
                <div class="grid-container" style="
                    width: 30px;
                    height: 30px;
                    border: 1px solid black;
                    border-radius: 15%;
                    padding: 6px;
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr;
                    grid-template-rows: 1fr 1fr 1fr;
                    gap: 3px 3px;
                    grid-template-areas:
                    'upper-left . upper-right'
                    'center-left center center-right'
                    'lower-left . lower-right';
                ">$rolledNumber</div>
EOT;
    }
}
