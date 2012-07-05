<?php

namespace Bav\Validator;

abstract class IterationWeighted extends Iteration
{
    
    protected $weights = array();
    
    protected $modulo = 10;
    
    protected function setWeights($weights)
    {
        $this->weights = $weights;
    }
    
    protected function setModulo($modulo)
    {
        $this->modulo = $modulo;
    }
    
    protected function getWeight() {
        return $this->weights[$this->i % count($this->weights)];
    }
    
    
}