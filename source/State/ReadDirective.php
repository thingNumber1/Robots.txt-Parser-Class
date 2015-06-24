<?php

namespace t1gor\RobotsTxt\State;

use t1gor\RobotsTxt\Parser;

/**
 * Class ReadDirective
 * @package t1gor\RobotsTxt\State
 */
final class ReadDirective extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'read-directive';
    }

    /**
     * @param Parser $p
     * @return Parser
     */
    public function process(Parser $p)
    {
        $p->switchDirectives();
        $content = $p->getContent();

        // move cursor
        $content->increment();

        if ($content->isLineSeparator()) {
            $content->flushWord();
            $p->setState(new ReadValue());
        }
        else {
            if ($content->isSpace()) {
                $p->setState(new SkipSpace());
            }
            if ($content->isSharp()) {
                $p->setState(new SkipLine());
            }
        }
        return $p;
    }
}