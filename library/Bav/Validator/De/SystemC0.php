<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemC0 extends \Bav\Validator\Base
{

    protected $validator;
    protected $mode1;
    protected $mode2;
    
    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        $this->mode1 = new System09($bank);
        
        $this->mode2 = new System06($bank);
        $this->mode2->setWeights(array(2, 3, 4, 5, 6, 7));
    }
    
    protected function validate()
    {
        $this->validator = array_search($this->account{7}, array(1, 2, 3, 6)) !== false
                         ? $this->mode1
                         : $this->mode2;
    }
    /**
     * @return bool
     */
    protected function getResult()
    {
        return strlen(ltrim($this->account, '0')) === 10
            && $this->account{0} !== '8'
            && $this->validator->isValid($this->account);
    }
    
}