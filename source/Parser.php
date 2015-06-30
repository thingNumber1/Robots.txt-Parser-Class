<?php

namespace t1gor\RobotsTxt;

use \t1gor\RobotsTxt\Content\ContentInterface;
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
     * @var array
     */
    protected $rules = array();

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
    }

    /**
     * @param ContentInterface $content
     * [@param string $encoding]
     * @return $this
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
            $this->step();
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
     * Machine step
     * @return $this
     */
    protected function step() {
        return $this->state->process($this);
    }

    /**
     * Public method to advance internal state
     * @return $this
     */
    public function switchDirectives()
    {
        $this->state->setPreviousDirective($this->state->getCurrentDirective());
        $this->state->setCurrentDirective($this->content->getDirectiveFromCurrentWord());
        return $this;
    }

    /**
     * Proxy as state is protected
     * @return Directive\DirectiveInterface
     */
    public function getCurrentDirective()
    {
        return $this->state->getCurrentDirective();
    }

    /**
     * Set current user agent
     * @param string $newAgent
     */
    public function setUserAgent($newAgent = '*')
    {
        $this->userAgent = $newAgent;

        // create empty array if not there yet
        if (empty($this->rules[$this->userAgent])) {
            $this->rules[$this->userAgent] = array();
        }
    }

    /**
     * Prepare rule value and set the one
     * @param callable $convert
     * @param bool     $append
     * @return void
     */
    public function addRule(callable $convert = null, $append = true)
    {
        $cWord = $this->getContent()->getCurrentWord();
        $dName = $this->state->getCurrentDirective()->getName();

        // convert value
        $value = (null !== $convert)
            ? call_user_func($convert, $cWord)
            : $cWord;

        // set to rules
        if ($append === true) {
            $this->rules[$this->userAgent][$dName][] = $value;
        }
        else {
            $this->rules[$this->userAgent][$dName] = $value;
        }
    }
}