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
 * @package Encoder
 * @author Dennis Lassiter <dennis@lassiter.de>
 * @copyright Copyright (C) 2012 Dennis Lassiter
 */

namespace Bav\Encoder;

class Iso8859 implements \Bav\EncoderInterface
{
    
    /**
     *
     * @param string $string
     * @param string $fromEncoding
     * @return string
     * @throws \Exception 
     */
    public function convert($string, $fromEncoding)
    {
//        if ($fromEncoding == 'UTF-8') {
            return $string;
//        }
//        throw new \Exception();
    }
    
    /**
     * Get the length of a string
     * 
     * @param string $string
     * @return int Length of string
     */
    public function strlen($string)
    {
        return strlen($string);
    }
    
    /**
     * Get substring of a string
     * 
     * @param string $string
     * @param int $offset
     * @param int $length
     * @return string 
     */
    public function substr($string, $offset, $length = null)
    {
        if (is_null($length)) {
            return substr($string, $offset);
        }
        
        return substr($string, $offset, $length);
    }
    
    /**
     * Checks to see if the this encoder is supported for an encoding
     * 
     * @param type $encoding 
     */
    public static function isSupported($encoding)
    {
        return (bool) preg_match('~^ISO-8859-([1-9]|1[0-5])$~', $encoding);
    }
}