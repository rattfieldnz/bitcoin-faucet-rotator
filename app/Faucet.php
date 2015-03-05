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
                           'min_payout',
                           'max_payout',
                           'has_ref_program',
                           'ref_payout_percent',
                           'comments',
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

    /**
     * A method to tell user if a faucet
     * has a referral program or not, in
     * a readable format.
     * @return string
     */
    public function hasRefProgram()
    {
        if($this->attributes['has_ref_program'])
        {
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
        if($this->attributes['is_paused'])
        {
            return 'Paused';
        }
        return 'Active';
    }

}
