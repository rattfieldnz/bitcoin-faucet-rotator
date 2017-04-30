<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

/**
 * Class Faucet
 *
 *
 * A model class for a faucet.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App
 */
class Faucet extends AppModel
{

	use Sluggable, Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faucets';

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
        return $this->belongsToMany(PaymentProcessor::class, 'faucet_payment_processor')->orderBy('name');
    }

    /**
     * A method defining the relationship between
     * a faucet and users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'referral_info');
    }

    /**
     * Get linked keywords.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'faucets_keywords');
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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
