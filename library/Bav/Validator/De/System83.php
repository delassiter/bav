<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System83 extends \Bav\Validator\Chain
{
    
    protected $modeC;
    
    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        $this->defaultValidators[] = new System32($bank);
        $this->defaultValidators[0]->setWeights(array(2, 3, 4, 5, 6, 7));
        $this->defaultValidators[0]->setEnd(3);
        
        $this->defaultValidators[] = new System33($bank);
        $this->defaultValidators[1]->setWeights(array(2, 3, 4, 5, 6));
        $this->defaultValidators[1]->setEnd(4);
        
        $this->modeC = new System33($bank);
        $this->defaultValidators[] = $this->modeC;
        $this->defaultValidators[2]->setWeights(array(2, 3, 4, 5, 6));
        $this->defaultValidators[2]->setEnd(4);
        $this->defaultValidators[2]->setModulo(7);
        
        $this->exceptionValidators[] = new System83x($bank);
    }
    
    protected function init($account)
    {
        parent::init($account);
        
        $this->validators = substr($this->account, 2, 2) == 99
                          ? $this->exceptionValidators
                          : $this->defaultValidators;
    }
    
    protected function continueValidation(\Bav\Validator\Base $validator)
    {
        return $validator !== $this->modeC || $this->account{9} < 7;
    }
}