<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Behat\Exception\BehaviorException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use GeorgetteParty\GMFBundle\Exception\IllegalMoveException;
use GeorgetteParty\GMFBundle\Model\GoBoard;
use GeorgetteParty\GMFBundle\Model\GoGame;
use GeorgetteParty\GMFBundle\Model\GoPlayer;

use GeorgetteParty\GMFBundle\Features\Bootstrap\GameContext;
use GeorgetteParty\GMFBundle\Features\Bootstrap\I;

// Require 3rd-party libraries here:
//

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
require_once __DIR__ . "/../../Tests/bootstrap.php";

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{


    use GameContext;
    use I;


    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }



}
