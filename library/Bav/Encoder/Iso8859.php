<?php

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