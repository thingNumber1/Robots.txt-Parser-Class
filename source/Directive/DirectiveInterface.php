<?php

namespace t1gor\RobotsTxt\Directive;

/**
 * Interface DirectiveInterface
 * @package t1gor\RobotsTxt\Directive
 */
interface DirectiveInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $word
     * @return bool
     */
    public function matches($word);

    /**
     * @return string
     */
    public function getValue();
}