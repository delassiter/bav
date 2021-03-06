<?php

namespace Bav\Validator\De;

/**
 * Test class for System68.
 * Generated by PHPUnit on 2012-07-05 at 19:22:55.
 */
class System68Test extends \Bav\Test\SystemTestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('987654328');

        foreach ($validAccounts as $account) {
            $validator = new System68($this->bank);
            $this->assertTrue($validator->isValid($account));
        }
    }

    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('223456600', '455555555');

        foreach ($validAccounts as $account) {
            $validator = new System68($this->bank);
            $this->assertFalse($validator->isValid($account));
        }
    }

}