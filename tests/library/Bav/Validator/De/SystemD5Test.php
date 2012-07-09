<?php

namespace Bav\Validator\De;

/**
 * Test class for SystemD5.
 * Generated by PHPUnit on 2012-07-05 at 19:22:55.
 */
class SystemD5Test extends \Bav\Test\SystemTestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('5999718138', '4711173', '4711172', '100062');

        foreach ($validAccounts as $account) {
            $validator = new SystemD5($this->bank);
            $this->assertTrue($validator->isValid($account));
        }
    }

    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('0399242139','1123458', '100085');

        foreach ($validAccounts as $account) {
            $validator = new SystemD5($this->bank);
            $this->assertFalse($validator->isValid($account));
        }
    }

}