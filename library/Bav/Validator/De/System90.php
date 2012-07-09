<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System90 extends \Bav\Validator\Chain
{

    protected $modeF;
    
    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        $this->defaultValidators[] = new System06($bank);
        $this->defaultValidators[0]->setWeights(array(2, 3, 4, 5, 6, 7));
        $this->defaultValidators[0]->setEnd(3);
        
        $this->defaultValidators[] = new System06($bank);
        $this->defaultValidators[1]->setWeights(array(2, 3, 4, 5, 6));
        $this->defaultValidators[1]->setEnd(4);
        
        $this->defaultValidators[] = new System90c($bank);
        $this->defaultValidators[] = new System90d($bank);
        $this->defaultValidators[] = new System90e($bank);
        
        $this->modeF = new System06($bank);
        $this->modeF->setWeights(array(2, 3, 4, 5, 6, 7, 8));
        $this->modeF->setEnd(2);
    }

    protected function init($account) {
        parent::init($account);
        
        $this->validators = $this->account{2} == 9
                          ? array($this->modeF)
                          : $this->defaultValidators;
    }
}