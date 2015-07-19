<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MainMeta extends Model {

    protected $table = 'main_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'keywords'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

}
