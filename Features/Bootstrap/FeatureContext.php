<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Behat\Exception\BehaviorException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Goutte\QuadsphereGoBundle\Exception\IllegalMoveException;
use Goutte\QuadsphereGoBundle\Model\GoBoard;
use Goutte\QuadsphereGoBundle\Model\GoGame;
use Goutte\QuadsphereGoBundle\Model\GoPlayer;

use Goutte\QuadsphereGoBundle\Features\Bootstrap\GameContext;
use Goutte\QuadsphereGoBundle\Features\Bootstrap\I;

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
