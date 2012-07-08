<?php

namespace Bav\Validator\De;

/**
 * Test class for System91.
 * Generated by PHPUnit on 2012-07-05 at 19:22:55.
 */
class System91Test extends \PHPUnit_Framework_TestCase
{

    public function testWithValidAccountReturnsTrue()
    {
        $validAccounts = array('2974118000', '5281741000', '2974117000', '5281770000', '8840019000', '884001200');

        foreach ($validAccounts as $account) {
            $validator = new System91();
            $this->assertTrue($validator->isValid($account));
        }
    }

    public function testWithInvalidAccountReturnsFalse()
    {
        $validAccounts = array('8840010000', '8840062000');

        foreach ($validAccounts as $account) {
            $validator = new System91();
            $this->assertFalse($validator->isValid($account));
        }
    }

}