<?php

namespace Bav\Validator\De;

use Bav\Validator\Math;

class SystemD0 extends \Bav\Validator\Base
{
    const SWITCH_PREFIX = '57';
    
    protected $validator;

    
    protected function validate()
    {
        $this->validator = substr($this->account, 0, 2) !== self::SWITCH_PREFIX
                         ? new System20($this->bank)
                         : new System09($this->bank);
    }
    
    
    /**
     * @return bool
     */
    protected function getResult()
    {
        return $this->validator->isValid($this->account);
    }
    
}