<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Class Faucet
 * 
 * A model class for a faucet.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $interval_minutes
 * @property integer $min_payout
 * @property integer $max_payout
 * @property boolean $has_ref_program
 * @property integer $ref_payout_percent
 * @property string $comments
 * @property boolean $is_paused
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property boolean $has_low_balance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PaymentProcessor[] $paymentProcessors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereIntervalMinutes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereMinPayout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereMaxPayout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereHasRefProgram($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereRefPayoutPercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereIsPaused($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereMetaKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faucet whereHasLowBalance($value)
 * @mixin \Eloquent
 */
class Faucet extends Model implements SluggableInterface
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faucets';
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
                           'url',
                           'interval_minutes',
                           'min_payout',
                           'max_payout',
                           'has_ref_program',
                           'ref_payout_percent',
                           'comments',
                           'is_paused',
                           'meta_title',
                           'meta_description',
                           'meta_keywords',
                           'has_low_balance'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * A method defining the relationship between
     * a faucet and payment processors.
     */
    public function paymentProcessors()
    {
        return $this->belongsToMany('App\PaymentProcessor', 'faucet_payment_processor');
    }

    /**
     * A method defining the relationship between
     * a faucet and users.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'referral_info');
    }

    /**
     * A method to tell user if a faucet
     * has a referral program or not, in
     * a readable format.
     * @return string
     */
    public function hasRefProgram()
    {
        if ($this->attributes['has_ref_program']) {
            return 'Yes';
        }
        return 'No';
    }
    /**
     * A method to tell user if a faucet
     * is paused or not, in
     * a readable format.
     * @return string
     */
    public function status()
    {
        if ($this->attributes['is_paused']) {
            return 'Paused';
        }
        return 'Active';
    }

    public function lowBalanceStatus()
    {
        if ($this->attributes['has_low_balance'] == true) {
            return 'Yes';
        }
        return 'No';
    }
}
