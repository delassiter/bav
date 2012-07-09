<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemA3 extends \Bav\Validator\Chain
{

    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        $this->validators[] = new System00($bank);
        $this->validators[0]->setWeights(array(2, 1));
        
        $this->validators[] = new System10($bank);
        $this->validators[1]->setWeights(array(2, 3, 4, 5, 6, 7, 8, 9, 10));
    }

    
}