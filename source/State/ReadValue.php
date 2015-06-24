<?php

namespace t1gor\RobotsTxt\State;

use Guzzle\Common\Exception\BadMethodCallException;
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
     */
    protected function addValueToDirective(Parser $p)
    {
//        switch ($this->current_directive)
//        {
//            case self::DIRECTIVE_USERAGENT:
//                $this->setUserAgent($this->current_word);
//                break;
//
//            case self::DIRECTIVE_CRAWL_DELAY:
//                $this->addRule("floatval", false);
//                break;
//
//            case self::DIRECTIVE_SITEMAP:
//            case self::DIRECTIVE_CLEAN_PARAM:
//                $this->addRule();
//                break;
//
//            case self::DIRECTIVE_HOST:
//                $this->addRule("trim", false);
//                break;
//
//            case self::DIRECTIVE_ALLOW:
//            case self::DIRECTIVE_DISALLOW:
//                if (empty($this->current_word)) {
//                    break;
//                }
//                $this->addRule("self::prepareRegexRule");
//                break;
//        }
//
//        // clean-up
//        $this->current_word = "";
//        $this->switchState(self::STATE_ZERO_POINT);

        throw new BadMethodCallException('Not implemented');
    }
}