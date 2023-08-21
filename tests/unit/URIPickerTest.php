<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../bootstrap.php";

/**
 * Tests URIPicker.
 *
 * @license WTFPL
 * @author Markus Malkusch <markus@malkusch.de>
 */
class URIPickerTest extends TestCase
{

    /**
     * Provides URIPicker implementations.
     *
     * @return URIPicker[][]
     */
    public function provideURIPicker()
    {
        return array(
            array(new DOMURIPicker()),
        );
    }

    /**
     * Tests pickURI()
     */
    public function testPickURI()
    {
        $picker = new DOMURIPicker();

        $html = file_get_contents(__DIR__ . "/../data/bankleitzahlen_download.html");
        $uri = $picker->pickURI($html, new \DateTime('2016-04-26 00:00:00'));

        $this->assertEquals(
            // @codingStandardsIgnoreStart
            "/Redaktion/DE/Downloads/Aufgaben/Unbarer_Zahlungsverkehr/Bankleitzahlen/2016_06_05/blz_2016_03_07_txt.txt?__blob=publicationFile",
            // @codingStandardsIgnoreEnd
            $uri
        );
    }

    /**
     * Tests pickURI()
     *
     * @expectedException malkusch\bav\URIPickerException
     */
    public function testFailPickURI()
    {
        $picker = new DOMURIPicker();

        $html = "XXX";
        $picker->pickURI($html, new \DateTime());
    }

    /**
     * All pickers are available on this platform.
     */
    public function testIsAvailable()
    {
        $picker = new DOMURIPicker();

        $this->assertTrue($picker->isAvailable());
    }
}
