<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 * @property integer $id
 * @property string $user_name
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $bitcoin_address
 * @property boolean $is_admin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Faucet[] $faucets
 * @property-read \App\TwitterConfig $twitterConfig
 * @property-read \App\AdBlock $adBlock
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBitcoinAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

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
    protected $fillable = ['user_name',
        'first_name',
        'last_name',
        'email',
        'password',
        'bitcoin_address',
        'is_admin'];

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
        return $this->belongsToMany('App\Faucet', 'referral_info')->orderBy('interval_minutes', 'asc');
    }

    public function twitterConfig()
    {
        return $this->hasOne('App\TwitterConfig', 'user_id');
    }

    public function adBlock()
    {
        return $this->hasOne('App\AdBlock', 'user_id');
    }
}
