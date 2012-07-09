<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemB6 extends \Bav\Validator\Base
{

    protected $validator;
    protected $mode1;
    protected $mode2;
    
    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        
        $this->mode1 = new System20($bank);
        $this->mode1->setWeights(array(2, 3, 4, 5, 6, 7, 8, 9, 3));
        
        $this->mode2 = new System53($bank);
        $this->mode2->setWeights(array(2, 4, 8, 5, 10, 9, 7, 3, 6, 1, 2, 4));
    }
    
    protected function validate()
    {
        if ($this->account{0} !== '0' || preg_match("/^0269[1-9]/", $this->account)) {
            $this->validator = $this->mode1;

        } else {
            $this->validator = $this->mode2;
        }
    }
    
    /**
     * @return bool
     */
    protected function getResult()
    {
        return $this->validator->isValid($this->account, '0');
    }
    
}