<?php

namespace Bav\Validator\De;

/**
 * Test class for SystemA6.
 * Generated by PHPUnit on 2012-07-05 at 19:22:55.
 */
class SystemA6Test extends \PHPUnit_Framework_TestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('17', '800048548', '150178033');

        foreach ($validAccounts as $account) {
            $validator = new SystemA6();
            $this->assertTrue($validator->isValid($account));
        }
    }

    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('864089000', '87096000');

        foreach ($validAccounts as $account) {
            $validator = new SystemA6();
            $this->assertFalse($validator->isValid($account));
        }
    }

}