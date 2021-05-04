<?php

declare(strict_types=1);

namespace Pene14\Yatzy;

use function Mos\Functions\url;

class Yatzy
{
    private ScoreBoard $scoreBoard;
    private YatzyDiceHand $yatzyDiceHand;

    public function __construct() {
        $this->scoreBoard = new ScoreBoard();
        $this->yatzyDiceHand = new YatzyDiceHand();
    }

//    public function resetScoreBoard() {
//        $this->scoreBoard = new ScoreBoard();
//    }

    public function newDiceHand() {
        $this->yatzyDiceHand = new YatzyDiceHand();
    }

    public function saveDice($diceIndex) {
        $this->yatzyDiceHand->saveDice($diceIndex);
    }

    public function rollDie(): void {
        $this->yatzyDiceHand->rollDie();
    }

    public function updateSumAndBonus(): void {
        $this->scoreBoard->setSum();
        $this->scoreBoard->setBonus();
    }

    public function saveOnes(): void {
            $this->scoreBoard->setOnes($this->yatzyDiceHand->getDie());
            $this->updateSumAndBonus();
            $this->newDiceHand();
    }

    public function saveTwos(): void {
        $this->scoreBoard->setTwos($this->yatzyDiceHand->getDie());
        $this->updateSumAndBonus();
        $this->newDiceHand();
    }

    public function saveThrees(): void {
        $this->scoreBoard->setThrees($this->yatzyDiceHand->getDie());
        $this->updateSumAndBonus();
        $this->newDiceHand();
    }

    public function saveFours(): void {
        $this->scoreBoard->setFours($this->yatzyDiceHand->getDie());
        $this->updateSumAndBonus();
        $this->newDiceHand();
    }

    public function saveFives(): void {
        $this->scoreBoard->setFives($this->yatzyDiceHand->getDie());
        $this->updateSumAndBonus();
        $this->newDiceHand();
    }

    public function saveSixes(): void {
        $this->scoreBoard->setSixes($this->yatzyDiceHand->getDie());
        $this->updateSumAndBonus();
        $this->newDiceHand();
    }

    public function playYatzy(): array {
        if ($this->yatzyDiceHand->getThrowsLeft() === 3) {
            $this->yatzyDiceHand->rollDie();
        }
        // If no throws left, add score to scoreboard and throw a new dicehand
        return [
            "throwsLeft" => $this->yatzyDiceHand->getThrowsLeft(),
            "lastRolls" => $this->yatzyDiceHand->graphicalDie(),
            "dieStatus" => $this->yatzyDiceHand->dieStatus(),
            "resultsLeftToScore" => $this->scoreBoard->resultsLeftToScore(),
            "css" => url("/css/style.css"),
            "saveDice" => url("/yatzy/saveDice"),
            "rollAgain" => url("/yatzy/rollAgain"),
            "destroySession" => url("/yatzy/destroyGame"),
            "saveScores" => [
                url("/yatzy/saveOnes") => [
                        "Save ones" => $this->scoreBoard->getOnes()
                    ],
                url("/yatzy/saveTwos") => [
                        "Save twos" => $this->scoreBoard->getTwos()
                    ],
                url("/yatzy/saveThrees") => [
                    "Save threes" => $this->scoreBoard->getThrees()
                ],
                url("/yatzy/saveFours") => [
                    "Save fours" => $this->scoreBoard->getFours()
                ],
                url("/yatzy/saveFives") => [
                    "Save fives" => $this->scoreBoard->getFives()
                ],
                url("/yatzy/saveSixes") => [
                    "Save sixes" => $this->scoreBoard->getSixes()
                ],
            ],
            "currentResults" => $this->scoreBoard->currentResults(),
        ];
    }
}
