<?php

declare(strict_types=1);

namespace Pene14\Yatzy;
use Pene14\Dice\Dice;

class ScoreBoard
{
    private ?int $ones = null;
    private ?int $twos = null;
    private ?int $threes = null;
    private ?int $fours = null;
    private ?int $fives = null;
    private ?int $sixes = null;
    private ?int $chance = null;
    private ?int $sum = null;
    private ?int $bonus = null;

    public function setOnes(array $die): void
    {
        if ($this->ones === null) {
            $sum = 0;
            foreach ($die as $dice) {
                if ($dice->getLastRoll() === 1) {
                    $sum += $dice->getLastRoll();
                }
            }
            $this->ones = $sum;
        }
    }

    public function setTwos(array $die): void
    {
        if ($this->twos === null) {
            $sum = 0;
            foreach ($die as $dice) {
                if ($dice->getLastRoll() === 2) {
                    $sum += $dice->getLastRoll();
                }
            }
            $this->twos = $sum;
        }
    }

    public function setThrees(array $die): void
    {
        if ($this->threes === null) {
            $sum = 0;
            foreach ($die as $dice) {
                if ($dice->getLastRoll() === 3) {
                    $sum += $dice->getLastRoll();
                }
            }
            $this->threes = $sum;
        }
    }

    public function setFours(array $die): void
    {
        if ($this->fours === null) {
            $sum = 0;
            foreach ($die as $dice) {
                if ($dice->getLastRoll() === 4) {
                    $sum += $dice->getLastRoll();
                }
            }
            $this->fours = $sum;
        }
    }

    public function setFives(array $die): void
    {
        if ($this->fives === null) {
            $sum = 0;
            foreach ($die as $dice) {
                if ($dice->getLastRoll() === 5) {
                    $sum += $dice->getLastRoll();
                }
            }
            $this->fives = $sum;
        }
    }

    public function setSixes(array $die): void
    {
        if ($this->sixes === null) {
            $sum = 0;
            foreach ($die as $dice) {
                if ($dice->getLastRoll() === 6) {
                    $sum += $dice->getLastRoll();
                }
            }
            $this->sixes = $sum;
        }
    }

    public function setChance(array $die): void
    {
        if ($this->chance === null) {
            $sum = 0;
            foreach ($die as $dice) {
                    $sum += $dice->getLastRoll();
            }
            $this->chance = $sum;
        }
    }

    public function setSum(): void
    {
        $sumScores = array_sum(
                            array(
                                $this->getOnes(),
                                $this->getTwos(),
                                $this->getThrees(),
                                $this->getFours(),
                                $this->getFives(),
                                $this->getSixes(),
                                $this->getChance()
                            )
                        );

        $this->sum = $sumScores;
    }

    /**
     * @return int|null
     */
    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function setBonus(): void
    {
        if ($this->getSum() >= 63) {
            $this->bonus = 50;
            return;
        }
        $this->bonus = 0;
    }

    /**
     * @return int|null
     */
    public function getOnes(): ?int
    {
        return $this->ones;
    }

    /**
     * @return int|null
     */
    public function getTwos(): ?int
    {
        return $this->twos;
    }

    /**
     * @return int|null
     */
    public function getThrees(): ?int
    {
        return $this->threes;
    }

    /**
     * @return int|null
     */
    public function getFours(): ?int
    {
        return $this->fours;
    }

    /**
     * @return int|null
     */
    public function getFives(): ?int
    {
        return $this->fives;
    }

    /**
     * @return int|null
     */
    public function getSixes(): ?int
    {
        return $this->sixes;
    }

    /**
     * @return int|null
     */
    public function getChance(): ?int
    {
        return $this->chance;
    }

    /**
     * @return int
     */
    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    public function resultsLeftToScore(): bool
    {
        return !(
            $this->getOnes() !== null  &&
            $this->getTwos() !== null  &&
            $this->getThrees() !== null &&
            $this->getFours() !== null &&
            $this->getFives() !== null &&
            $this->getSixes() !== null
//            && $this->getChance()
        );
    }

    public function currentResults(): array {
        return [
            "Ones" => $this->getOnes(),
            "Twos" => $this->getTwos(),
            "Threes" => $this->getThrees(),
            "Fours" => $this->getFours(),
            "Fives" => $this->getFives(),
            "Sixes" => $this->getSixes(),
            "Bonus" => $this->getBonus(),
            "Sum" => $this->getSum(),
        ];

    }
}
