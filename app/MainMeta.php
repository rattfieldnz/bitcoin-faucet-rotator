<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MainMeta
 *
 * The model class for the site main meta.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App
 */
class MainMeta extends Model
{

    protected $table = 'main_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'google_analytics_id',
        'yandex_verification',
        'bing_verification',
        'addthisid',
        'twitter_username', 
        'page_main_title',
        'page_main_content'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
