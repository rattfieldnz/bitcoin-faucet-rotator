<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class PaymentProcessor extends Model implements SluggableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_processors';
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

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

