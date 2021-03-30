<?php

use PHPUnit\Framework\TestCase;
use TDD01\Bowling;

class BowlingTest extends TestCase
{
    /**
     * @var Bowling
     */
    private Bowling $game;

    protected function setUp(): void
    {
        $this->game = new Bowling();
    }

    /** @test */
    public function doitRenvoyer0SiPasDeRoll()
    {
        $this->assertEquals("0", $this->game->getScore());
    }

    /** @test */
    public function doitRenvoyer7SiRollDe7()
    {
        $this->game->roll(7);

        $this->assertEquals("7", $this->game->getScore());
    }

    /** @test */
    public function doitRenvoyerLeScoreDe2Rolls()
    {
        $this->game->roll(1);
        $this->game->roll(2);

        $this->assertEquals("3", $this->game->getScore());
    }

    /** @test */
    public function doitRenvoyerLeScoreDe3Rolls()
    {
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(8);

        $this->assertEquals("11", $this->game->getScore());
    }

    /** @test */
    public function doitRenvoyerLeScoreFinalApres20Rolls()
    {
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(1);
        $this->game->roll(2);

        $this->assertEquals("Partie terminée; Score final : 30", $this->game->getScore());
    }

    /** @test */
    public function doitPouvoirRenvoyerPendingSurUnSpare()
    {
        $this->game->roll(6);
        $this->game->roll(4);

        $this->assertEquals("pending", $this->game->getScore());
    }

    /** @test */
    public function doitDonnerLeScoreAvecLeBonusApresUnSpare()
    {
        $this->game->roll(6);
        $this->game->roll(4);

        $this->game->roll(2);

        $this->assertEquals("14", $this->game->getScore());
    }

    /** @test */
    public function doitRenvoyerPendingApresChaqueSpare()
    {
        $this->game->roll(2);
        $this->game->roll(8);

        $this->game->roll(5);
        $this->game->roll(5);

        $this->assertEquals("pending", $this->game->getScore());
    }

    /** @test */
    public function doitRenvoyerPendingApresUnSpare()
    {
        $this->game->roll(2);
        $this->game->roll(4);

        $this->game->roll(5);
        $this->game->roll(5);

        $this->assertEquals("pending", $this->game->getScore());
    }


    /**
     * pas de roll => score = 0
     * roll !== 10 => score = 7
     * roll 6 + roll 2 => score = 8
     * roll 6 + roll 2 + roll 4 => score = 12
     * 20 rolls qui ne font jamais 10 par pair => score = xx
     * roll 6 + roll 4 => score = pending
     * spare
     * roll 6 + roll 4 + roll 2 => score = 14
     * roll 6 + roll 4 + roll 2 + roll 8 => score = pending
     * roll 6 + roll 4 + roll 2 + roll 8 + roll 6 + roll 1 => score = 35
     * strike
     * roll 10 => score = pending
     * roll 10 + roll 4 + roll 2 => score = 22
     * roll 10 + roll 10 => score = pending
     * roll 10 + roll 10 + roll 2 + roll 4 => score = 44
     * end game
     * 9 frames + roll 6 + roll 4 + roll 8  => score = XX
     * 9 frames + roll 6 + roll 4 + roll 10  => score = XX
     * 9 frames + roll 10 + roll 2 + roll 8  => score = XX
     * 9 frames + roll 10 + roll 2 + roll 6  => score = XX
     * 9 frames + roll 10 + roll 10 + roll 6  => score = XX
     * 9 frames + roll 10 + roll 10 + roll 10  => score = XX
     */

}
