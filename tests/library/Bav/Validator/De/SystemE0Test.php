<?php

namespace Bav\Validator\De;

class SystemE0Test extends \Bav\Test\SystemTestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('1234568013', '1534568010', '2610015', '8741013011');
    
        foreach ($validAccounts as $account) {
            $validator = new SystemE0($this->bank);
            $this->assertTrue($validator->isValid($account));
        }
    }
    
    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('1234769013', '2710014', '9741015011');
    
        foreach ($validAccounts as $account) {
            $validator = new SystemE0($this->bank);
            $this->assertFalse($validator->isValid($account));
        }
    }

}