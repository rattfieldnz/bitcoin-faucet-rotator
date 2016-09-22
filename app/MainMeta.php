<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MainMeta
 * 
 * The model class for the site main meta.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $google_analytics_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $yandex_verification
 * @property string $bing_verification
 * @property string $page_main_title
 * @property string $page_main_content
 * @property string $addthisid
 * @property string $twitter_username
 * @property string $feedburner_feed_url
 * @property string $disqus_shortname
 * @property boolean $prevent_adblock_blocking
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereGoogleAnalyticsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereYandexVerification($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereBingVerification($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta wherePageMainTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta wherePageMainContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereAddthisid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereTwitterUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereFeedburnerFeedUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta whereDisqusShortname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MainMeta wherePreventAdblockBlocking($value)
 * @mixin \Eloquent
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
        'feedburner_feed_url',
        'disqus_shortname',
        'prevent_adblock_blocking',
        'page_main_title',
        'page_main_content'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
