<?php

namespace Bav\Test;

class SystemTestCase extends \PHPUnit_Framework_TestCase
{
    protected $bank;
    
    public function setUp()
    {
        $this->bank = new \Bav\Bank('12345678', '00');
    }
}