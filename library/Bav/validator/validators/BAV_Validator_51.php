<?php







/**
 * implements 51
 *
 * Copyright (C) 2006  Markus Malkusch <markus@malkusch.de>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 *
 * @package classes
 * @subpackage validator
 * @author Markus Malkusch <markus@malkusch.de>
 * @copyright Copyright (C) 2006 Markus Malkusch
 */
class BAV_Validator_51 extends BAV_Validator_Chain {


    private
    /**
     * @var array
     */
    $defaultValidators = array(),
    /**
     * @var array
     */
    $exceptionValidators = array(),
    /**
     * @var BAV_Validator_33
     */
    $validatorC;
    
    
    public function __construct(BAV_Bank $bank) {
        parent::__construct($bank);
        
        $this->validatorC = new BAV_Validator_33($this->bank);
        
        $this->defaultValidators[] = new BAV_Validator_06($this->bank);
        $this->defaultValidators[] = new BAV_Validator_33($this->bank);
        $this->defaultValidators[] = $this->validatorC;
        
        $this->defaultValidators[0]->setWeights(array(2, 3, 4, 5, 6, 7));
        $this->defaultValidators[0]->setEnd(3);
        
        $this->defaultValidators[1]->setWeights(array(2, 3, 4, 5, 6));
        $this->defaultValidators[1]->setEnd(4);
        
        $this->defaultValidators[2]->setWeights(array(2, 3, 4, 5, 6));
        $this->defaultValidators[2]->setEnd(4);
        $this->defaultValidators[2]->setDivisor(7);
        
        $this->exceptionValidators = self::getExceptionValidators($bank);
    }
    
    
    /**
     * @return array
     */
    static public function getExceptionValidators(BAV_Bank $bank) {
        $exceptionValidators = array();
        $exceptionValidators[] = new BAV_Validator_51x($bank);
        $exceptionValidators[] = new BAV_Validator_51x($bank);
            
        $exceptionValidators[1]->setWeights(array(2, 3, 4, 5, 6, 7, 8, 9, 10));
        $exceptionValidators[1]->setEnd(0);
        
        return $exceptionValidators;
    }


    /**
     */
    protected function init($account) {
        parent::init($account);
        
        $this->validators = $this->account{2} == 9
                          ? $this->exceptionValidators
                          : $this->defaultValidators;
    }
    
    
    protected function continueValidation(BAV_Validator $validator) {
        if ($validator !== $this->validatorC) {
            return true;
        
        }
        switch ($this->account{9}) {
            case 7: case 8: case 9:
                return false;
        
            default:
                return true;
        
        }
    }


}


?>