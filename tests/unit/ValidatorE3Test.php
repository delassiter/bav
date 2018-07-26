<?php

namespace malkusch\bav;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Test for E3.
 *
 */
class ValidatorE3Test extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests for ValidatorE3 
     * 
     * @param string $account  The account id.
     * @param bool   $expected The expected validation result.
     * 
     * @dataProvider getE3TestAccounts
     */
    public function testE3($account, $expected)
    {
        $backend = $this->getMock('malkusch\bav\FileDataBackend');
        $bank = $this->getMock('malkusch\bav\Bank', [], [$backend, 1, 1]);
        
        $validator = new ValidatorE3($bank);
        $this->assertEquals($expected, $validator->isValid($account));
    }
    
    /**
     * Returns Deutsche Bundesbank E3 test accounts, see
     * https://www.bundesbank.de/Redaktion/DE/Downloads/Aufgaben/Unbarer_Zahlungsverkehr/pruefzifferberechnungsmethoden.pdf?__blob=publicationFile
     * 
     * @return array Test cases.
     */
    public function getE3TestAccounts()
    {
        //['2345678909',  false], ['5678901237',  false] are not used, as those numbers result to true via alternative method
        return [
            ['9290701',     true],
            ['539290858',   true],
            ['1501824',     true],
            ['1501832',     true],
            ['0123456789',  false],
            ['7414398260',  false],
            ['9290708',     true],
            ['539290854',   true],
            ['1501823',     true],
            ['1501831',     true],
            ['2345678909',  true],
            ['5678901237',  true],
            ['0123456789',  false],
            ['2345678901',  false],
            ['5678901234',  false],
            ['7414398260',  false],
        ];
    }
}
