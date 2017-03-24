<?php namespace App\Helpers\WebsiteMeta;

use App\MainMeta;
use Exception;
use RattfieldNz\UrlValidation\UrlValidation;

/**
 * Class WebsiteMeta
 *
 * A class to handle retrieval of a given URL's
 * website meta details
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App\Helpers\WebsiteMeta
 */
class WebsiteMeta
{

    private $url;
    private $urlMetaUrl = 'https://api.urlmeta.org?url=';
    private $urlContents;

    /**
     * WebsiteMeta constructor.
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        ini_set("allow_url_fopen", 1);
            $this->url = $this->urlMetaUrl . $url;
            $this->contents = $this->getUrlContents($this->url);
    }

    /**
     * A function to obtain title information from the current
     * URL's title meta tag.
     *
     * @return false|null|string
     */
    public function title()
    {
        try {
            return $this->contents->meta->title != null ? $this->contents->meta->title : "";
        } catch(Exception $e){
            return "";
        }
    }

    /**
     * A function to obtain keywords from the current URL's
     * keywords meta tag.
     *
     * @return string
     */
    public function keywords()
    {
        try {
            return $this->contents->meta->keywords != null ? $this->contents->meta->keywords : "";
        } catch(Exception $e){
            return "";
        }
    }

    /**
     * A function to retrieve the meta description of
     * the current URL.
     *
     * @return false|null|string
     */
    public function description()
    {
        try {
            return $this->contents->meta->description != null ? $this->contents->meta->description : "";
        } catch(Exception $e){
            return "";
        }
    }

    /**
     * Returns search engine verification ids.
     * @return array
     */
    public static function seVerificationIds()
    {
        return [
            'yandex_verification' => MainMeta::firstOrFail()->yandex_verification,
            'bing_verification' => MainMeta::firstOrFail()->bing_verification
        ];
    }

    /**
     * Returns the AddThis id.
     * @return mixed
     */
    public static function addThisId()
    {
        return MainMeta::firstOrFail()->addthisid;
    }

    /**
     * Returns the Twitter username.
     *
     * @return mixed
     */
    public static function twitterUsername()
    {
        return MainMeta::firstOrFail()->twitter_username;
    }

    /**
     * Returns the Feedburner feed URL.
     * @return mixed
     */
    public static function feedburnerFeedUrl()
    {
        return MainMeta::firstOrFail()->feedburner_feed_url;
    }

    public static function disqusShortName()
    {
        return MainMeta::firstOrFail()->disqus_shortname;
    }

    public static function activatedAdBlockBlocking()
    {
        return MainMeta::firstOrFail()->prevent_adblock_blocking;
    }

    private function getUrlContents($url){
        $content = file_get_contents($url);
        return json_decode($content);
    }
}
