<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System77 extends \Bav\Validator\Chain
{
    public function __construct()
    {

        $this->validators[] = new System77a();
        $this->validators[0]->setWeights(array(1, 2, 3, 4, 5));
        
        $this->validators[] = new System77a();
        $this->validators[1]->setWeights(array(5, 4, 3, 4, 5));
    }
}