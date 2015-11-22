<?php namespace App\Helpers\Functions;

use DOMDocument;
use Exception;
use RattfieldNz\UrlValidation\UrlValidation;

class HtmlParse
{
    private $url;

    public function __construct($url)
    {
        if (UrlValidation::urlExists($url) == true) {
            $this->url = $url;
        } else {
            throw new Exception('The URL does not exist or is experiencing technical issues.');
        }
    }

    /**
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
