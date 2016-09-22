<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Class PaymentProcessor
 *
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Faucet[] $faucets
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentProcessor whereMetaKeywords($value)
 * @mixin \Eloquent
 */
class PaymentProcessor extends Model implements SluggableInterface
{

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

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
