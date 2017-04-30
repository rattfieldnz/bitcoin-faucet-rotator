<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

/**
 * Class PaymentProcessor
 * @package App
 */
class PaymentProcessor extends AppModel
{

    use Sluggable, Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_processors';

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
        return $this->belongsToMany(Faucet::class, 'faucet_payment_processor');
    }

    /**
     * Get linked keywords.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'keywords_payment_processors');
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
