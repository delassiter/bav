<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemD9 extends \Bav\Validator\Chain
{

    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        $this->validators[] = new System00($bank);
        $this->validators[] = new System10($bank);
        $this->validators[] = new System18($bank);
    }
    
}