<?php

/**
 * Copyright (C) 2012  Dennis Lassiter <dennis@lassiter.de>
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
 * @package Backend
 * @subpackage Parser
 * @author Dennis Lassiter <dennis@lassiter.de>
 * @copyright Copyright (C) 2012 Dennis Lassiter
 */

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
