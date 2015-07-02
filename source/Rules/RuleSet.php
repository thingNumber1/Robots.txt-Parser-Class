<?php

namespace t1gor\RobotsTxt\Rules;

use \ArrayObject;

/**
 * Class RuleSet
 * @link http://php.net/manual/ru/class.arrayobject.php
 * @package t1gor\RobotsTxt\Rules
 */
class RuleSet extends ArrayObject
{
    /**
     * @param Rule $rule
     */
    public function addRule(Rule $rule)
    {
        $this->append($rule);
    }
}