<?php

namespace Bav;

class Encoder
{
    
    protected static $encoders = array(
        '\Bav\Encoder\Iso8859',
//        '\Bav\Encoder\Iconv',
//        '\Bav\Encoder\Mb',
    );
    
    public static function registerEncoder($class)
    {
        $r = new ReflectionClass($class);
        if (!$r->implementsInterface('\Bav\EncoderInterface')) {
            throw new \Exception();
        }
        
        self::$encoders[] = $class;
    }
    
    public static function unregisterEncoder($class)
    {
        if ($key = array_search($class, self::$encoders)) {
            unset(self::$encoders[$key]);
        }
    }
    
    public static function factory($encoding)
    {
        foreach (self::$encoders as $encoder) {
            if ($encoder::isSupported($encoding)) {
                return new $encoder;
            }
        }
        
        throw new \Exception();
    }
    
}