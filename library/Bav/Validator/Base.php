<?php

namespace Bav\Validator;

abstract class Base
{

    protected $normalizedSize = 10;
    
    protected $account = '';
    
    protected $checknumberPosition = -1;
    
    protected $doNormalization = true;
    
    public function getChecknumberPosition()
    {
        return $this->checknumberPosition;
    }

    public function setChecknumberPosition($checknumberPosition)
    {
        $this->checknumberPosition = $checknumberPosition;
    }

        
    protected function getChecknumber()
    {
        return $this->account{Math::getNormalizedPosition($this->account, $this->checknumberPosition)};
    }
    
    abstract protected function validate();
    
    public function isValid($account)
    {
        try {
            $this->init($account);
            $this->validate();
            return ltrim($account, "0") != "" && $this->getResult();
        } catch (Exception\OutOfBoundsException $e) {
            return false;
        }
        
    }
    
    /**
     * @param string $account
     * @return void
     */
    protected function init($account)
    {
        if ($this->doNormalization) {
            $account = $this->normalizeAccount($account, $this->normalizedSize);
        }
        
        $this->account = $account;
    }
    
    protected function normalizeAccount($account, $size)
    {
        $account = (string) $account;
        if (strlen($account) > $size) {
            throw new Exception\OutOfBoundsException("Can't normalize {$account} to size {$size}.");

        }
        
        return str_repeat('0', $size - strlen($account)) . $account;
    }
    
    abstract protected function getResult();
}