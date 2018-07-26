<?php

namespace malkusch\bav;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Test for E4.
 *
 */
class ValidatorE3Test extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests for ValidatorE4
     * 
     * @param string $account  The account id.
     * @param bool   $expected The expected validation result.
     * 
     * @dataProvider getE4TestAccounts
     */
    public function testE3($account, $expected)
    {
        $backend = $this->getMock('malkusch\bav\FileDataBackend');
        $bank = $this->getMock('malkusch\bav\Bank', [], [$backend, 1, 1]);
        
        $validator = new ValidatorE4($bank);
        $this->assertEquals($expected, $validator->isValid($account));
    }
    
    /**
     * Returns Deutsche Bundesbank E4 test accounts, see
     * https://www.bundesbank.de/Redaktion/DE/Downloads/Aufgaben/Unbarer_Zahlungsverkehr/pruefzifferberechnungsmethoden.pdf?__blob=publicationFile
     * 
     * @return array Test cases.
     */
    public function getE4TestAccounts()
    {
        //['1501824',  false], ['1501832',  false], ['9290701',  false] are not used, as those numbers result to true via alternative method
        return [
            ['1501836',     true],
            ['9290702',     true],
            ['539290858',   true],
            ['12345007',    false],
            ['87654005',    false],
            ['1501824',     true],
            ['1501832',     true],
            ['9290701',     true],
            ['12345007',    false],
            ['87654005',    false],
        ];
    }
}
