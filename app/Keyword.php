<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Keyword
 * @package App
 */
class Keyword extends Model
{

    use Sluggable, Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keywords';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'keyword',
        'slug',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get linked faucets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function faucets(){
        return $this->belongsToMany(Faucet::class, 'faucets_keywords');
    }

    /**
     * Get linked payment processors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paymentProcessors(){
        return $this->belongsToMany(PaymentProcessor::class, 'keywords_payment_processors');
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
                'source' => 'keyword'
            ]
        ];
    }
}
