<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 23-Oct-2015
 * Time: 21:28
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class FacebookConfig extends Model
{
    protected $table = 'facebook_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'app_id',
        'app_secret',
        'access_token',
        'facebook_id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}