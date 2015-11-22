<?php namespace App\Helpers\WebsiteMeta;

use App\MainMeta;

class WebsiteMeta
{

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
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

    public function description()
    {
        $description = $this->meta()->getDescription();

        if ($description != false) {
            return $description;
        }
        return null;
    }

    /**
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
}
