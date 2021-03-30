<?php


namespace TDD01;

class Bowling
{
    private $score = 0;
    private $frames = [];
    const NOMBRE_MAX_DE_FRAMES = 10;

    public function getScore(): string
    {
        $messageRetour = "";
        for ($numeroDeFrame = 0; $numeroDeFrame < count($this->frames); $numeroDeFrame++) {
            $this->score += $this->frames[$numeroDeFrame]->getScore();
            if ($this->frames[$numeroDeFrame]->isASpare() && $numeroDeFrame === count($this->frames) - 1) {
                $messageRetour = "pending";
            } elseif ($this->frames[$numeroDeFrame]->isASpare()) {
                $prochaineFrame = $this->frames[$numeroDeFrame + 1];
                $this->score += $prochaineFrame->getFirstRoll();
            }
            $onEstSurLeDernierTour = count($this->frames) === static::NOMBRE_MAX_DE_FRAMES;
            if ($onEstSurLeDernierTour) $messageRetour = "Partie terminée; Score final : " . $this->score;
        }
        if ($messageRetour === "") $messageRetour = $this->score;

        return $messageRetour;
    }

    public function roll(int $nbQuilles)
    {
        if (count($this->frames) === 0 || end($this->frames)->isFinished()) {
            $frame = new Frame();
            $frame->addRoll($nbQuilles);
            $this->frames[] = $frame;
        } else {
            end($this->frames)->addRoll($nbQuilles);
        }

    }
}

class Frame
{
    private $roll1;
    private $roll2;

    public function addRoll($roll)
    {
        if ($this->roll1 === null) {
            $this->roll1 = $roll;
        } else {
            $this->roll2 = $roll;
        }
    }

    public function isFinished()
    {
        return $this->roll1 !== null && $this->roll2 !== null;
    }

    public function getScore()
    {
        return $this->roll1 + $this->roll2;
    }

    public function isASpare()
    {
        return $this->roll1 + $this->roll2 === 10;
    }

    public function getFirstRoll()
    {
        return $this->roll1;
    }

}