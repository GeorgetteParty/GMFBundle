<?php

namespace GeorgetteParty\GMFBundle\Features\Bootstrap;

use Behat\Behat\Exception\BehaviorException;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use GeorgetteParty\GMFBundle\Exception\IllegalMoveException;
use GeorgetteParty\GMFBundle\Model\GoBoard;
use GeorgetteParty\GMFBundle\Model\GoGame;
use GeorgetteParty\GMFBundle\Model\GoPlayer;

trait GameContext
{

    /**
     * @var GoGame
     */
    protected $game;

    public function getGame()
    {
        if (empty($this->game)) {
            throw new BehaviorException("There's no game !");
        }
        return $this->game;
    }

    /**
     * @Transform /^(-?\d+)$/
     */
    public function castStringToNumber($string)
    {
        return intval($string);
    }

    /**
     * @Given /^I am (white|black) in a game of size (\d+)$/
     */
    public function iAmInAGameOfSize($color, $size)
    {
        $this->I = new GoPlayer();

        $w = new GoPlayer();
        $b = new GoPlayer();

        if ('white' == $color) {
            $this->I = $w;
        } else {
            $this->I = $b;
        }

        $game = new GoGame($b,$w);
        var_dump($size);
        $board = new GoBoard($game, array('size'=>$size));
        $game->setBoard($board);

        $this->game = $game;
    }

    /**
     * @Given /^it is (my|white's|black's) turn$/
     */
    public function itIsSomebodysTurn($whose)
    {
        $game = $this->getGame();

        if ('my' == $whose) {
            $somebody = $this->I();
        } else if ("'black's" == $whose) {
            $somebody = $game->getBlack();
        } else if ("'white's" == $whose) {
            $somebody = $game->getWhite();
        } else {
            throw new PendingException();
        }

        $game->setCurrentPlayer($somebody);
    }

    /**
     * @Given /^the game looks like(?: this) ?:$/
     */
    public function theGameLooksLikeThis(PyStringNode $string)
    {
        $game = $this->getGame();
        $game->fromString($string);
    }


    protected $move_rejected = false;

    /**
     * @When /^I (?:try to )play at (-?\d+) (-?\d+) (-?\d+)$/
     */
    public function iTryToPlayAt($x, $y, $z)
    {
        $game = $this->getGame();

        try {
            $game->playerPlaysAt($this->I(), array($x, $y, $z));
        } catch (IllegalMoveException $e) {
            $this->move_rejected = true;
        }
    }

    /**
     * @Then /^I the game should reject (?:my|white's|black's) move$/
     */
    public function iTheGameShouldRejectMyMove()
    {
        assertTrue($this->move_rejected);
        $this->move_rejected = false;
    }

    /**
     * @Given /^it should still be (my|white's|black's) turn$/
     */
    public function itShouldStillBeTheTurnOf($whom)
    {
        $game = $this->getGame();

        if ('my' == $whom) {
            $somebody = $this->I();
        } else if ("'black's" == $whom) {
            $somebody = $game->getBlack();
        } else if ("'white's" == $whom) {
            $somebody = $game->getWhite();
        } else {
            throw new PendingException();
        }

        assertTrue($game->isTurnOf($somebody), "It's not $whom turn");
    }


}