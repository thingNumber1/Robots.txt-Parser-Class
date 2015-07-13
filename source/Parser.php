<?php

namespace t1gor\RobotsTxt;

use \t1gor\RobotsTxt\Content\ContentInterface;
use \t1gor\RobotsTxt\Rules\RuleSet;
use \t1gor\RobotsTxt\State\StateInterface;
use \t1gor\RobotsTxt\State\ZeroPoint;

/**
 * Class for parsing robots.txt files
 *
 * @author Igor Timoshenkov (igor.timoshenkov@gmail.com)
 *
 * Logic schema and signals:
 * @link https://docs.google.com/document/d/1_rNjxpnUUeJG13ap6cnXM6Sx9ZQtd1ngADXnW9SHJSE/edit
 *
 * Some useful links and materials:
 * @link https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt
 * @link http://help.yandex.com/webmaster/?id=1113851
 * @link http://socoder.net/index.php?snippet=23824
 * @link http://www.the-art-of-web.com/php/parse-robots/#.UP0C1ZGhM6I
 */
class Parser {

    /**
     * @var \t1gor\RobotsTxt\State\StateInterface
     */
    protected $state;

    /**
     * @var \t1gor\RobotsTxt\Content\ContentInterface
     */
    protected $content;

    /**
     * @var \t1gor\RobotsTxt\Rules\RuleSet
     */
    protected $rules;

    /**
     * @var string
     */
    protected $userAgent = '*';

    /**
     * Setup default values
     */
    public function __construct()
    {
        // set default state
        $this->setState(new ZeroPoint());

        // init object
        $this->rules = new RuleSet();
    }

    /**
     * @param ContentInterface $content
     * [@param string $encoding]
     * @return $this
     * @throws \t1gor\RobotsTxt\Content\Exception\InvalidEncoding
     */
    public function setContent(ContentInterface $content, $encoding = null)
    {
        $this->content = $content;

        // set encoding if passed
        if (null !== $encoding) {
            $this->content->setEncoding($encoding);
        }

        return $this;
    }

    /**
     * @return \t1gor\RobotsTxt\Content\ContentInterface
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param StateInterface $state
     * @return $this
     */
    public function setState(StateInterface $state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Parse rules
     * @return void
     */
    public function parse()
    {
        // while have content - go!
        while ($this->content->getCharIndex() <= $this->content->length()) {
            $this->state->process($this);
        }

        /**
         * @todo rewrite this to new interface
         */
        foreach ($this->rules as $userAgent => $directive) {
            foreach ($directive as $directiveName => $directiveValue) {
                if (is_array($directiveValue)) {
                    $this->rules[$userAgent][$directiveName] = array_values(array_unique($directiveValue));
                }
            }
        }
    }

    /**
     * Public method to advance internal state
     * @return $this
     */
    public function switchDirectives()
    {
        $cDirective = $this->state->getCurrentDirective();
        $this->state->setPreviousDirective($cDirective);

        $newDirective = $this->content
            ->getHelper()
            ->getDirectiveFromCurrentWord();
        $this->state->setCurrentDirective($newDirective);

        return $this;
    }

    /**
     * @return \t1gor\RobotsTxt\State\StateInterface
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return \t1gor\RobotsTxt\Rules\RuleSet
     */
    public function getRules()
    {
        return $this->rules;
    }
}