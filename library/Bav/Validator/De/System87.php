<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System87 extends \Bav\Validator\Chain
{

    
    public function __construct()
    {

        $this->defaultValidators[] = new System87a();
        
        $this->defaultValidators[] = new System33();
        $this->defaultValidators[1]->setWeights(array(2, 3, 4, 5, 6));
        $this->defaultValidators[1]->setEnd(4);
        
        $this->defaultValidators[] = new System87c();
        
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