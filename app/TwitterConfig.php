<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TwitterConfig
 *
 * @property integer $id
 * @property string $consumer_key
 * @property string $consumer_key_secret
 * @property string $access_token
 * @property string $access_token_secret
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereConsumerKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereConsumerKeySecret($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereAccessToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereAccessTokenSecret($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TwitterConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TwitterConfig extends Model
{

    protected $table = 'twitter_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'consumer_key',
        'consumer_key_secret',
        'access_token',
        'access_token_secret',
        'user_id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
