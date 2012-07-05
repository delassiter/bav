<?php

namespace Bav\Validator;

class Math
{
    
    /**
     * Calculate the crosssum of an integer
     * 
     * @param int $int
     * @return int 
     */
    public static function crossSum($int)
    {
        $sum = 0;
        $strInt = (string) $int;
        
        for ($i = 0; $i < strlen($strInt); $i++) {
            $sum += $strInt{$i};
        }
        
        return $sum;
    }
    
    
    public static function getNormalizedPosition($account, $position)
    {
        if ($position >= strlen($account) || $position < -strlen($account)) {
    		throw new Exception\OutOfBoundsException("Cannot access offset {$position} in String {$account}");
    		
    	}
    	
        if ($position >= 0) {
            return $position;
        }
        
        return strlen($account) + $position;
    }
    
    public function normalizeAccount($account, $size)
    {
        $account = (string) $account;
        if (strlen($account) > $size) {
            throw new Exception\OutOfBoundsException("Can't normalize {$account} to size {$size}.");

        }
        
        return str_repeat('0', $size - strlen($account)) . $account;
    }
    
}