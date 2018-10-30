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

        $result = $xpath->query("(//a[contains(@href, '.txt')]/@href)");

        foreach ($result as $item) {
            $link = $item->value;
            $dateResult = $xpath->query("(//a[contains(@href, '".$link."')])");
            $dateRange= $dateResult->item(0)->nodeValue??null;

            $matchCount = preg_match_all('/\d{2}\.\d{2}\.\d{4}/', $dateRange, $matches);

            if ($matchCount !== 2) {
                continue;
            }

            $minDate = new \DateTime($matches[0][0]);
            $maxDate = new \DateTime($matches[0][1]);

            if ($minDate <= $currentDate && $currentDate <= $maxDate) {
                return $link;
            }
        }

        throw new URIPickerException("Did not find download URI");
    }
}
