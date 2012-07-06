<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System00 extends \Bav\Validator\IterationWeighted
{
    
    protected $weights = array(2, 1);
    protected $modulo = 10;
    
    
    protected function iterationStep()
    {
        $this->accumulator += Math::crossSum($this->number * $this->getWeight());
    }

    protected function getResult()
    {
        $result = $this->modulo - ($this->accumulator % $this->modulo);
        $result = ($result == $this->modulo) ? 0 : $result;
        return (string)$result === $this->getCheckNumber();
    }
}