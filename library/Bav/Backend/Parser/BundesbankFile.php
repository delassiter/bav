<?php

namespace Bav\Backend\Parser;

use Bav\Exception as BavException;

class BundesbankFile
{
    
    const BANKID_OFFSET     = 0;
    const BANKID_LENGTH     = 8;
    const ISMAIN_OFFSET     = 8;
    const ISMAIN_LENGTH     = 1;
    const NAME_OFFSET       = 9;
    const NAME_LENGTH       = 58;
    const POSTCODE_OFFSET   = 67;
    const POSTCODE_LENGTH   = 5;
    const CITY_OFFSET       = 72;
    const CITY_LENGTH       = 35;
    const SHORTTERM_OFFSET  = 107;
    const SHORTTERM_LENGTH  = 27;
    const PAN_OFFSET        = 134;
    const PAN_LENGTH        = 5;
    const BIC_OFFSET        = 139;
    const BIC_LENGTH        = 11;
    const TYPE_OFFSET       = 150;
    const TYPE_LENGTH       = 2;
    const ID_OFFSET         = 152;
    const ID_LENGTH         = 6;
    
    
    private
    /**
     * @var resource
     */
    $fp,
    /**
     * @var string
     */
    $file = '',
    /**
     * @var int,
     */
    $lines = 0,
    /**
     * @var int
     */
    $lineLength = 0;
    
    protected $encoder;
    
    
    /**
     * @param String $file The data source
     */
    public function __construct($file, $encoding)
    {
        $this->file = $file;
        $this->encoding = $encoding;
    }

    /**
     *
     * @return void
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     */
    private function init()
    {
        if (is_resource($this->fp)) {
            return;
        
        }
        $this->fp = @fopen($this->file, 'r');
        if (!is_resource($this->fp)) {
            if (!file_exists($this->file)) {
                throw new BavException\FileNotFoundException("File {$this->file} not found.");
            } else {
                throw new BavException\IoException("Failed to open stream {$this->file}");
                
            }
        
        }
        
        $dummyLine = fgets($this->fp, 1024);
        if (! $dummyLine) {
            throw new BavException\IoException("Failed to open stream {$this->file}");
        }
        $this->lineLength = strlen($dummyLine);
        
        clearstatcache(); // filesize() seems to be 0 sometimes
        $filesize = filesize($this->file);
        if (! $filesize) {
            throw new BavException\IoException("Could not read filesize for {$this->file}");
        
        }        
        $this->lines = floor(($filesize - 1) / $this->lineLength);
    }
    
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     * @return int
     */
    public function getLines()
    {
        $this->init();
        return $this->lines;
    }
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     */
    public function rewind()
    {
        if (fseek($this->getFileHandle(), 0) === -1) {
            throw new BavException\IoException();
        
        }
    }
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     * @param int $line
     * @param int $offset
     */
    public function seekLine($line, $offset = 0)
    {
        if (fseek($this->getFileHandle(), $line * $this->lineLength + $offset) === -1) {
            throw new BavException\IoException();
        
        }
    }
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     * @param int $line
     * @return string
     */
    public function readLine($line)
    {
        $this->seekLine($line);
        return $this->encoder->convert(fread($this->getFileHandle(), $this->lineLength), self::FILE_ENCODING);
    }
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     * @param int $line
     * @return string
     */
    public function getBankId($line)
    {
        $this->seekLine($line, self::BANKID_OFFSET);
        return $this->encoder->convert(fread($this->getFileHandle(), self::BANKID_LENGTH), self::FILE_ENCODING);
    }
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     * @return resource
     */
    public function getFileHandle()
    {
        $this->init();
        return $this->fp;
    }
    /**
     * @throws BavException\FileNotFoundException
     * @throws BavException\IoException 
     * @return int
     */
    public function getLineLength()
    {
        $this->init();
        return $this->lineLength;
    }
    /**
     */
    public function __destruct()
    {
        if (is_resource($this->fp)) {
            fclose($this->fp);

        }
    }
    /**
     * @throws Exception\ParseException
     * @param string $line
     * @return \Bav\Bank
     */
    public function getBank($line)
    {
        if ($this->encoder->strlen($line) < self::TYPE_OFFSET + self::TYPE_LENGTH) {
            throw new Exception\ParseException("Invalid line length in Line {$line}.");
        
        }
        $type   = $this->encoder->substr($line, self::TYPE_OFFSET,      self::TYPE_LENGTH);
        $bankID = $this->encoder->substr($line, self::BANKID_OFFSET,    self::BANKID_LENGTH);
        return new \Bav\Bank($bankID, $type);
    }
    /**
     * @throws Exception\ParseException
     * @param string $line
     * @return \Bav\Bank\Agency
     */
    public function getAgency(BAV_Bank $bank, $line)
    {
        if ($this->encoder->strlen($line) < self::ID_OFFSET + self::ID_LENGTH) {
            throw new Exception\ParseException("Invalid line length.");
        
        }
        $id   = trim($this->encoder->substr($line, self::ID_OFFSET, self::ID_LENGTH));
        $name = trim($this->encoder->substr($line, self::NAME_OFFSET, self::NAME_LENGTH));
        $shortTerm = trim($this->encoder->substr($line, self::SHORTTERM_OFFSET, self::SHORTTERM_LENGTH));
        $city = trim($this->encoder->substr($line, self::CITY_OFFSET, self::CITY_LENGTH));
        $postcode = $this->encoder->substr($line, self::POSTCODE_OFFSET, self::POSTCODE_LENGTH);
        $bic = trim($this->encoder->substr($line, self::BIC_OFFSET, self::BIC_LENGTH));
        $pan = trim($this->encoder->substr($line, self::PAN_OFFSET, self::PAN_LENGTH));
        return new \Bav\Bank\Agency($id, $bank, $name, $shortTerm, $city, $postcode, $bic, $pan);
    }
    /**
     * @throws Exception\ParseException
     * @param string $line
     * @return bool
     */
    public function isMainAgency($line)
    {
        if ($this->encoder->strlen($line) < self::TYPE_OFFSET + self::TYPE_LENGTH) {
            throw new Exception\ParseException("Invalid line length.");
        
        }
        return $this->encoder->substr($line, self::ISMAIN_OFFSET, 1) === '1';
    }
    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
    
}