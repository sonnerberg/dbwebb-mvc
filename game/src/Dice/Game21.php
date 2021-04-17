<?php

declare(strict_types=1);

namespace Pene14\Dice;

use function Mos\Functions\{
    renderTwigView,
    sendResponse,
    url
};


class Game21
{
    private array $humanScoreSum = array();
    private array $computerScoreSum = array();
    private ?int $numberDice = null;
    private DiceHand $humanDiceHand;
    private DiceHand $computerDiceHand;
    private bool $stopPlaying = false;
    private array $scoreBoard = ['human' => 0, 'computer' => 0];
    private bool $gameOver = false;


    public function playGame21(): void {
        if (!$this->gameOver()) {
            if ($this->getNumberDice() && !$this->stopPlaying) {
                $this->rollAgain();
            }
            if ($this->stopPlaying) {
                $this->computerRollTill21();
            }
            $this->updateScoreBoard();
        }
        $this->renderHTML();
    }

    private function gameOver(): bool {
        return (bool)$this->checkWinner();
    }

    private function updateScoreBoard() {
        $winner = $this->checkWinner();
        if ($winner) {
            $this->scoreBoard[$winner] = ++$this->scoreBoard[$winner];
            $this->gameOver = true;
        }
    }

    public function resetAndPlayAgain() {
        $this->gameOver = false;
        $this->stopPlaying = false;
        $this->resetComputerScoreSum();
        $this->resetHumanScoreSum();
    }

    private function computerRollTill21() {
        while ($this->getComputerScoreSum() < 21) {
            $this->computerDiceHand = new DiceHand($this->getNumberDice());
            $this->computerDiceHand->rollDie();
            $this->setComputerScoreSum($this->computerDiceHand->getSumLastRolls());
        }
    }

    private function renderHTML(): void {
        $data = [
            "header" => "Dice",
            "message" => "Hey,play some die!",
            "chooseNumberDice" => url("/game21/chooseNumberDice"),
            "destroySession" => url("/session/destroyGame"),
            "rollAction" => url("/game21"),
        ];
        if ($this->getNumberDice()) {
            $data["human"] =  $this->humanDiceHand->graphicalDie();
            $data["humanSum"] =  $this->humanDiceHand->getLastRolls();
            $data["humanScore"] =  $this->getHumanScoreSum();
            $data["computer"] =  $this->computerDiceHand->graphicalDie();
            $data["computerSum"] =  $this->computerDiceHand->getLastRolls();
            $data["computerScore"] =  $this->getComputerScoreSum();
            $data["numberDice"] = $this->getNumberDice();
            $data["stopPlaying"] = url("/game21/stopPlaying");
            $data["resetAndPlayAgain"] = url("/game21/resetAndPlayAgain");
            $data['winner'] = $this->checkWinner();
            $data['scoreBoard'] = $this->scoreBoard;
        }
        $body = renderTwigView("game21.html", $data);
        sendResponse($body);
    }

    private function checkWinner(): ?string {
        $winner = null;
        $computer = 'computer';
        $human = 'human';
        if ($this->getComputerScoreSum() === 21) {
            $winner = $computer;
            $this->stopPlaying();
        } else if ($this->getHumanScoreSum() > 21) {
            $winner = $computer;
            $this->stopPlaying();
        } else if ($this->getComputerScoreSum() > 21) {
            $winner = $human;
            $this->stopPlaying();
        }

        return $winner;
    }

    /**
     * @return void
     */
    private function rollAgain(): void {
            # Start the game
            $this->humanDiceHand = new DiceHand($this->getNumberDice());
            $this->computerDiceHand = new DiceHand($this->getNumberDice());
            $this->humanDiceHand->rollDie();
            $this->computerDiceHand->rollDie();

            $this->setComputerScoreSum($this->computerDiceHand->getSumLastRolls());
            $this->setHumanScoreSum($this->humanDiceHand->getSumLastRolls());
    }

    public function stopPlaying() {
        $this->stopPlaying = true;
    }

    /**
     * @return int
     */
    private function getNumberDice(): ?int
    {
        return $this->numberDice;
    }

    /**
     * @param int $numberDice
     */
    public function setNumberDice(int $numberDice): void
    {
        $this->numberDice = $numberDice;
    }

    /**
     * @return int
     */
    private function getHumanScoreSum(): int
    {
        return array_sum($this->humanScoreSum);
    }

    private function resetHumanScoreSum() {
        $this->humanScoreSum = array();
    }

    private function resetComputerScoreSum() {
        $this->computerScoreSum = array();
    }

    /**
     * @param int $humanScore
     */
    private function setHumanScoreSum(int $humanScore): void
    {
        $this->humanScoreSum[] = $humanScore;
    }

    /**
     * @return int
     */
    private function getComputerScoreSum(): int
    {
        return array_sum($this->computerScoreSum);
    }

    /**
     * @param int $computerScore
     */
    private function setComputerScoreSum(int $computerScore): void
    {
        $this->computerScoreSum[] = $computerScore;
    }
}
