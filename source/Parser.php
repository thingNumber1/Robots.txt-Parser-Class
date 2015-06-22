<?php

namespace t1gor\RobotsTxt;

use t1gor\RobotsTxt\Repository;
use \t1gor\RobotsTxt\Content\ContentInterface;
use \t1gor\RobotsTxt\State\StateInterface;
use \t1gor\RobotsTxt\State\ZeroPoint;
use \t1gor\RobotsTxt\State\ReadDirective;
use \t1gor\RobotsTxt\State\SkipSpace;
use \t1gor\RobotsTxt\State\SkipLine;
use \t1gor\RobotsTxt\State\ReadValue;

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
     * Setup default values
     */
    public function __construct()
    {
        // set default state
        $this->changeState(new ZeroPoint());
        // an attempt to avoid creating 100500 instances
        $this->repo = new Repository();
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
     * @param StateInterface $state
     * @return $this
     */
    protected function changeState(StateInterface $state)
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
     *
     * @return void
     */
    protected function step()
    {
        switch ($this->state)
        {
            case ($this->state instanceof ZeroPoint):
                $this->zeroPoint();
                break;

            case ($this->state instanceof ReadDirective):
                $this->readDirective();
                break;

            case ($this->state instanceof SkipSpace):
                $this->skipSpace();
                break;

            case ($this->state instanceof SkipLine):
                $this->skipLine();
                break;

            case ($this->state instanceof ReadValue):
                $this->readValue();
                break;
        }
    }

    /**
     * Check if we should switch
     * @return bool
     */
    protected function shouldSwitchToZeroPoint()
    {
        return in_array($this->content->getCurrentWord(), array(
            $this->repo->get('\t1gor\RobotsTxt\Directive\Allow')->getName(),
            $this->repo->get('\t1gor\RobotsTxt\Directive\Disallow')->getName(),
            $this->repo->get('\t1gor\RobotsTxt\Directive\Host')->getName(),
            $this->repo->get('\t1gor\RobotsTxt\Directive\UserAgent')->getName(),
            $this->repo->get('\t1gor\RobotsTxt\Directive\SiteMap')->getName(),
            $this->repo->get('\t1gor\RobotsTxt\Directive\CrawlDelay')->getName(),
            $this->repo->get('\t1gor\RobotsTxt\Directive\CleanParam')->getName()
        ), true);
    }

    /**
     * Process state ZERO_POINT
     * @return $this
     */
    protected function zeroPoint()
    {
        if ($this->shouldSwitchToZeroPoint()) {
            $this->changeState(
                $this->repository->get('ZeroPoint')
            );
        }
        // unknown directive - skip it
        elseif ($this->newLine()) {
            $this->current_word = "";
            $this->increment();
        }
        else {
            $this->increment();
        }
        return $this;
    }
}