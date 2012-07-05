<?php

namespace Bav;

interface EncoderInterface
{
    
    static public function isSupported($encoding);
    public function strlen($string);
    public function substr($string, $offset, $length = null);
    public function convert($string, $fromEncoding);
    
}