<?php namespace app\Helpers\Validators;

use Illuminate\Validation\Validator;

/**
 * Class MainMetaValidator
 *
 * A class to handle validation of main meta
 * updates and creation.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package app\Helpers\Validators
 */
class MainMetaValidator extends Validator
{
    public static function validationRules()
    {
        return [
            'title' => 'min:10|max:70',
            'description' => 'min:20|max:160',
            'keywords' => 'min:3|max:255',
            'google_analytics_code' => 'max:20',
            'yandex_verification' => 'max:70',
            'bing_verification' => 'max:70',
            'addthisid' => 'max:35',
            'twitter_username' => 'max:35',
            'feedburner_feed_url' => 'max:255',
            'disqus_shortname' => 'max:100', 
            'page_main_title' => 'required|min:15|max:100',
            'prevent_adblock_blocking' => 'min:0|max:1'
        ];
    }
}
