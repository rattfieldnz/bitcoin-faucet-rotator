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

    /**
     * WebsiteMeta constructor.
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
     * A function to obtain title information from the current
     * URL's title meta tag.
     *
     * @return false|null|string
     */
    public function title()
    {
        $title = $this->meta()->getTitle();
        if ($title != false) {
            return $title;
        }
        return null;
    }

    /**
     * A function to obtain keywords from the current URL's
     * keywords meta tag.
     *
     * @return string
     */
    public function keywords()
    {
        $keywordsArray = $this->meta()->getKeywords();
        $keywordsString = '';
        if (count($keywordsArray) > 0) {
            for ($i = 0; $i < count($keywordsArray); $i++) {
                if ($i == count($keywordsArray) - 1) {
                    $keywordsString .= $keywordsArray[$i];
                }
                $keywordsString .= $keywordsArray[$i] . ', ';
            }
        }
        return $keywordsString;
    }

    /**
     * A function to retrieve the meta description of
     * the current URL.
     *
     * @return false|null|string
     */
    public function description()
    {
        $description = $this->meta()->getDescription();

        if ($description != false) {
            return $description;
        }
        return null;
    }

    /**
     * A function used to return a MetaParser object
     * which is then used to handle HTML retrieval.
     *
     * @return MetaParser
     */
    public function meta()
    {
        $curler = (new Curler());
        $body = $curler->get($this->url);
        $parser = (new MetaParser($body, $this->url));
        return $parser;
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
}
