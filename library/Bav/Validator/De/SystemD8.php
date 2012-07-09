<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemD8 extends \Bav\Validator\Base
{

    protected $validator;
    
    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        
        $this->validator = new System00($bank);
    }
    
    protected function validate()
    {

    }
    
    /**
     * @return bool
     */
    protected function getResult()
    {
        if ($this->account{0} != 0) {
            return $this->validator->isValid($this->account);

        }
        $set = (int) substr($this->account, 0, 3);
        return $set >= 1 && $set <= 9;
    }
    
    
}