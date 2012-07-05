<?php

namespace Bav\Backend;
use Bav\BackendInterface;

class BundesbankFile implements BackendInterface
{
    
    protected $content = array();
    protected $parser = array();
    
    public function __construct($fileName, $encoding = 'ISO-8859-15')
    {
        $this->parser = new Parser\BundesbankFile($fileName, $encoding);
    }
    
    /**
     * Check if Bank exists
     * 
     * @param int $bankID
     * @return boolean 
     */
    public function bankExists($bankID)
    {
        try {
            $this->getBank($bankID);
            return true;
        } catch (Exception\BankNotFoundException $e) {
            return false;
        }
    }
    
    public function getAgencies(Bank $bank)
    {
        
    }
    
    public function getAllBanks()
    {
        
    }
    
    public function getBank($bankID)
    {
        
    }
    
    public function getMainAgency(Bank $bank)
    {
        
    }
    
    /**
     * 
     * @throws BAV_DataBackendException_BankNotFound
     * @throws BAV_FileParserException_ParseError
     * @throws BAV_FileParserException_IO
     * @param int $bankID
     * @param int $offset the line number to start
     * @param int $length the line count
     * @return BAV_Bank
     */
    protected function findBank($bankID, $offset, $end)
    {
        if ($end - $offset < 0) {
            throw new Exception\BankNotFoundException("Bank with ID {$bankID} not found");
        
        }
        
        $line = $offset + (int)(($end - $offset) / 2);
        $blz  = $this->parser->getBankId($line);
        
        /**
         * This handling is bad, as it may double the work
         */
        if ($blz == '00000000') {
            try { 
                return $this->findBank($bankID, $offset, $line - 1);
                
            } catch (Exception\BankNotFoundException $e) {
                return $this->findBank($bankID, $line + 1, $end);
            
            }
            
        } elseif (! isset($this->contextCache[$blz])) {
           $this->contextCache[$blz] = new Parser\Context\BundesbankBank($line);

        }
        
        if ($blz < $bankID) {
            return $this->findBank($bankID, $line + 1, $end);
        
        } elseif ($blz > $bankID) {
            return $this->findBank($bankID, $offset, $line - 1);
            
        } else {
            return $this->parser->getBank($this, $this->parser->readLine($line));
        
        }
    }

}