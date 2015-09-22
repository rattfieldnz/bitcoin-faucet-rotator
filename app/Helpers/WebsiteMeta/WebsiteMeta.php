<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 29-Jul-2015
 * Time: 13:54
 */

namespace App\Helpers\WebsiteMeta;

use App\MainMeta;

class WebsiteMeta
{

    private $url;

    public function __construct($url){
        $this->url = $url;
    }

    /**
     * @return false|null|string
     */
    public function title(){
        $title = $this->meta()->getTitle();
        if($title != false){
            return $title;
        }
        else{
            return null;
        }
    }

    public function keywords(){
        $keywords_array = $this->meta()->getKeywords();
        $keywords_string = '';
        if(count($keywords_array) > 0){

            for($i = 0; $i < count($keywords_array); $i++){

                if($i == count($keywords_array) - 1){
                    $keywords_string .= $keywords_array[$i];
                }
                else{
                    $keywords_string .= $keywords_array[$i] . ', ';
                }
            }
        }
        return $keywords_string;
    }

    public function description(){
        $description = $this->meta()->getDescription();

        if($description != false){
            return $description;
        }
        else{
            return null;
        }
    }

    /**
     * @return MetaParser
     */
    public function meta(){
        $curler = (new Curler());
        $body = $curler->get($this->url);
        $parser = (new MetaParser($body, $this->url));
        return $parser;
    }

    /**
     * Returns search engine verification ids.
     * @return array
     */
    public static function seVerificationIds(){
        return [
            'yandex_verification' => MainMeta::firstOrFail()->yandex_verification,
            'bing_verification' => MainMeta::firstOrFail()->bing_verification
        ];
    }
}