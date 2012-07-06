<?php

namespace Bav\Validator\De;

/**
 * Test class for System43.
 * Generated by PHPUnit on 2012-07-05 at 19:22:55.
 */
class System43Test extends \PHPUnit_Framework_TestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('6135244', '9516893476');

        foreach ($validAccounts as $account) {
            $validator = new System43();
            $this->assertTrue($validator->isValid($account));
        }
    }

    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('1000805', '539290855');

        foreach ($validAccounts as $account) {
            $validator = new System43();
            $this->assertFalse($validator->isValid($account));
        }
    }

}