<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 29-Jul-2015
 * Time: 13:54
 */

namespace App\Helpers\WebsiteMeta;


class WebsiteMeta
{

    public static function metaTags($url){
        return get_meta_tags($url);
    }

    public static function description($url, $limit = 157){

        $description = self::metaTags($url)['description'] != null ||
                       strlen(self::metaTags($url)['description']) != 0 ?
                       self::metaTags($url)['description'] : null;

        if($description != null ){
            self::ellipsify($description, $limit);
        }
        else{
            return null;
        }
    }

    public static function keywords($url){
        return self::metaTags($url)['keywords'];
    }

    public static function title($url, $limit = 67){
        $data = file_get_contents($url);
        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
        if($title != null && strlen($title) > 0){
            self::ellipsify($title, $limit);
        }else{
            return null;
        }
    }

    private static function ellipsify($string, $limit){
        if(strlen($string) == $limit - 3){
            return substr($string, 0, $limit) . "...";
        }
        else{
            return substr($string, 0, $limit);
        }
    }
}