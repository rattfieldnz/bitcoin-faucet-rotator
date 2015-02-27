<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Faucet extends Model {

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
                           'payout_amount',
                           'has_ref_program',
                           'ref_payout_percent',
                           'is_paused'];

    /**
     * A method defining the relationship between
     * a faucet and payment processors.
     */
    public function payment_processors()
    {
        $this->belongsToMany('App\PaymentProcessor', 'faucet_payment_processor');
    }

    /**
     * A method defining the relationship between
     * a faucet and users.
     */
    public function users()
    {
        $this->belongsToMany('App\User', 'referral_info');
    }

}
