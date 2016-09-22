<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdBlock
 * 
 * A model class for an ad block.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package App
 * @property integer $id
 * @property string $ad_content
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\AdBlock whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdBlock whereAdContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdBlock whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdBlock extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ad_block';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ad_content',
        'user_id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
