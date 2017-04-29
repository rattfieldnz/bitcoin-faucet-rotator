<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Notifiable;

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'email',
        'password',
        'bitcoin_address',
        'is_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * A method defining the relationship
     * between a payment user and
     * associated faucets.
     */
    public function faucets()
    {
        return $this->belongsToMany(Faucet::class, 'referral_info')->orderBy('interval_minutes', 'asc');
    }

    public function twitterConfig()
    {
        return $this->hasOne(TwitterConfig::class, 'user_id');
    }

    public function adBlock()
    {
        return $this->hasOne(AdBlock::class, 'user_id');
    }
}
