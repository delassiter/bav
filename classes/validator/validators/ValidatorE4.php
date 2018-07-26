<?php

namespace malkusch\bav;

/**
 * Implements E4
 */
class ValidatorE4 extends Validator
{
    /**
     * @var bool The validation result.
     */
    private $result;

    /**
     * based on https://www.bundesbank.de/Redaktion/DE/Downloads/Aufgaben/Unbarer_Zahlungsverkehr/pruefzifferberechnungsmethoden.pdf?__blob=publicationFile
     */
    protected function validate()
    {
        $validator = new Validator02($this->bank);
        $validator->setWeights([2, 3, 4, 5, 6, 7, 8, 9, 2]);
        $validator->setDivisor(11);

        $this->result = $validator->isValid($this->account);

        if(!$this->result) {
            $validator = new Validator00($this->bank);
            $this->result = $validator->isValid($this->account);
        }
    }
    
    protected function getResult()
    {
        return $this->result;
    }
}
