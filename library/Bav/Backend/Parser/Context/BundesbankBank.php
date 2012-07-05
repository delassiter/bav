<?php

namespace Bav\Backend\Parser\Context;

class BundesbankBank
{
    

    private
    /**
     * @var int any line of the context
     */
    $line = 0,
    /**
     * @var int the first line in the context
     */
    $start = null,
    /**
     * @var int the last line of the context
     */
    $end = null;
    
    
    /**
     * @param string $bankID
     * @param int $line
     */
    public function __construct($line) {
        $this->line   = $line;
    }
    /**
     * @return int
     */
    public function getLine() {
        return $this->line;
    }
    /**
     * @throws BAV_FileParserContextException_Undefined
     * @return int
     */
    public function getStart() {
        if (is_null($this->start)) {
            throw new \Exception();
        }
        return $this->start;
    }
    /**
     * @return bool
     */
    public function isStartDefined() {
        return ! is_null($this->start);
    }
    /**
     * @throws BAV_FileParserContextException_Undefined
     * @return int
     */
    public function getEnd() {
        if (is_null($this->end)) {
            throw new \Exception();
        
        }
        return $this->end;
    }
    /**
     * @return bool
     */
    public function isEndDefined() {
        return ! is_null($this->end);
    }
    /**
     * @param int $start
     */
    public function setStart($start) {
        $this->start = $start;
    }
    /**
     * @param int $end
     */
    public function setEnd($end) {
        $this->end = $end;
    }
}
