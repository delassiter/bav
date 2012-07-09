<?php

namespace Bav\Validator\De;

/**
 * Test class for SystemD4.
 * Generated by PHPUnit on 2012-07-05 at 19:22:55.
 */
class SystemD4Test extends \Bav\Test\SystemTestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('1112048219', '6286304975');

        foreach ($validAccounts as $account) {
            $validator = new SystemD4($this->bank);
            $this->assertTrue($validator->isValid($account));
        }
    }

    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('359432843', '3051681017');

        foreach ($validAccounts as $account) {
            $validator = new SystemD4($this->bank);
            $this->assertFalse($validator->isValid($account));
        }
    }

}