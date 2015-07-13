<?php

namespace t1gor\RobotsTxt\State;

use \BadMethodCallException;
use t1gor\RobotsTxt\Parser;

/**
 * Class ReadValue
 * @package t1gor\RobotsTxt\State
 */
final class ReadValue extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'read-value';
    }

    /**
     * @param Parser $p
     * @return Parser
     */
    public function process(Parser $p)
    {
        $content = $p->getContent();

        if ($content->isNewLine()) {
            $this->addValueToDirective($p);
        }
        elseif ($content->isSharp()) {
            $content->removeLastCharFromCurrentWord();
            $this->addValueToDirective($p);
        }
        else {
            $content->increment();
        }

        return $p;
    }

    /**
     * @param Parser $p
     * @return Parser
     */
    protected function addValueToDirective(Parser $p)
    {
        // process
        $p->getCurrentDirective()->addRule($p);

        // clean-up
        $p->getContent()->setWord('');
        $p->setState(new ZeroPoint());

        return $p;
    }
}