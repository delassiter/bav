<?php

namespace malkusch\bav;

/**
 * Implements E3
 */
class ValidatorE3 extends Validator
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
        $validator = new Validator00($this->bank);
        $this->result = $validator->isValid($this->account);

        if(!$this->result) {
            $validator = new Validator21($this->bank);
            $this->result = $validator->isValid($this->account);
        }
    }
    
    protected function getResult()
    {
        return $this->result;
    }
}
