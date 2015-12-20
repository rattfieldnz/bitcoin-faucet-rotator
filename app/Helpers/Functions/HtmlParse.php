<?php namespace App\Helpers\Functions;

use DOMDocument;
use Exception;
use RattfieldNz\UrlValidation\UrlValidation;

/**
 * Class HtmlParse
 *
 * A class used to handle HTML parsing of a URL.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Helpers\Functions
 */
class HtmlParse
{
    private $url;

    /**
     * HtmlParse constructor.
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        if (UrlValidation::urlExists($url) == true) {
            $this->url = $url;
        } else {
            throw new Exception('The URL does not exist or is experiencing technical issues.');
        }
    }

    /**
     * A function to retrieve the HTML of the current URL.
     *
     * @return DOMDocument
     */
    public function retrieveHtml()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $data = curl_exec($ch);
        curl_close($ch);

        $doc = new DOMDocument();
        /** @var DOMDocument $doc */
        @$doc->loadHTML($data);

        return $doc;
    }
}
