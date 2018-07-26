<?php

namespace malkusch\bav;

/**
 * Finds the download URI in the Bundesbank HTML page with XPath.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license WTFPL
 */
class DOMURIPicker implements URIPicker
{

    /**
     * Returns true if this implementation is available on this platform.
     *
     * @return bool
     */
    public function isAvailable()
    {
        return class_exists("\DOMXPath");
    }

    /**
     * Returns the download URI from the Bundesbank html page.
     *
     * @param string    $html
     * @param \DateTime $currentDate
     *
     * @throws URIPickerException
     *
     * @return string
     */
    public function pickURI($html, \DateTime $currentDate)
    {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);

        $xpath = new \DOMXpath($doc);

        $result = $xpath->query(
            "(//a[contains(*/text(), 'Bankleitzahlendateien') and contains(@href, '.txt')]/@href)"
        );

        $currentDateInt = (int) $currentDate->format('Ymd');

        foreach ($result as $item) {
            $link = $item->value;

            $matchCount = preg_match_all('/\d{4}_\d{2}_\d{2}/', $link, $matches);

            if ($matchCount !== 2) {
                continue;
            }

            $minDateInt = (int) str_replace('_', '', $matches[0][1]);
            $maxDateInt = (int) str_replace('_', '', $matches[0][0]);

            if ($minDateInt <= $currentDateInt && $currentDateInt <= $maxDateInt) {
                return $link;
            }
        }

        throw new URIPickerException("Did not find download URI");
    }
}
