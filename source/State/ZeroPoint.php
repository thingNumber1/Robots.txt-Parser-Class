<?php

namespace t1gor\RobotsTxt\State;

use \t1gor\RobotsTxt\Parser;
use \t1gor\RobotsTxt\Directive\Allow;
use \t1gor\RobotsTxt\Directive\Disallow;
use \t1gor\RobotsTxt\Directive\Host;
use \t1gor\RobotsTxt\Directive\UserAgent;
use \t1gor\RobotsTxt\Directive\Sitemap;
use \t1gor\RobotsTxt\Directive\CrawlDelay;
use \t1gor\RobotsTxt\Directive\CleanParam;

/**
 * Class ZeroPoint
 * @package t1gor\RobotsTxt\State
 */
final class ZeroPoint extends AbstractState implements StateInterface
{
    /**
     * @var string
     */
    protected static $name = 'zero-point';

    /**
     * Check if we should switch
     * @param string $currentWord
     * @return bool
     */
    protected function shouldSwitchToZeroPoint($currentWord)
    {
        return in_array($currentWord, [
            Allow::getName(),
            Disallow::getName(),
            Host::getName(),
            UserAgent::getName(),
            Sitemap::getName(),
            CrawlDelay::getName(),
            CleanParam::getName()
        ], true);
    }

    /**
     * @param Parser $p
     * @return Parser
     */
    public function process(Parser $p)
    {
        $content = $p->getContent();
        $cword = $content->getCurrentWord();

        if ($this->shouldSwitchToZeroPoint($cword)) {
            $p->setState(new ZeroPoint());
        }
        // unknown directive - skip it
        elseif ($content->getHelper()->isNewLine()) {
            $content
                ->setWord('')
                ->increment();
        }
        else {
            $content->increment();
        }
        return $p;
    }
}