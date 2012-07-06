<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System80 extends \Bav\Validator\Chain
{
    public function __construct()
    {

        $this->defaultValidators[] = new System00();
        $this->defaultValidators[0]->setEnd(4);
        
        $this->defaultValidators[] = new System00();
        $this->defaultValidators[1]->setEnd(4);
        $this->defaultValidators[1]->setModulo(7);
        
        $this->exceptionValidators = System51::getExceptionValidators();
    }
    
    protected function init($account)
    {
        parent::init($account);
        
        $this->validators = $this->account{2} == 9
                          ? $this->exceptionValidators
                          : $this->defaultValidators;
    }
}