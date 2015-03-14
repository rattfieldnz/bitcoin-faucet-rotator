<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentProcessor extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_processors';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'url'];

    /**
     * A method defining the relationship
     * between a payment processor and
     * associated faucets.
     */
    public function faucets()
    {
        return $this->belongsToMany('App\Faucet', 'faucet_payment_processor');
    }

}

