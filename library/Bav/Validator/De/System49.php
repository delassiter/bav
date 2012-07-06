<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class System49 extends \Bav\Validator\Chain
{
    
    public function __construct()
    {
        $this->validators = array(
            new System00(),
            new System01()
        );
    }
    
}