<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemB9 extends \Bav\Validator\Base
{

    protected $validator;
    protected $mode1;
    protected $mode2;
    
    public function __construct(\Bav\Bank $bank)
    {
        parent::__construct($bank);
        $this->mode1 = new SystemB9a($bank);
        $this->mode2 = new SystemB9b($bank);
    }
    
    protected function validate()
    {
        if (! preg_match('~^000?[^0]~', $this->account)) {
            $this->validator = null;
            return;
        
        }
        $this->validator = substr($this->account, 0, 3) === '000'
                         ? $this->mode2
                         : $this->mode1;
    }
    
    
    /**
     * @return bool
     */
    protected function getResult()
    {
        return ! is_null($this->validator) && $this->validator->isValid($this->account);
    }
}