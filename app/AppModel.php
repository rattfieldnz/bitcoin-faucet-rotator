<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 30/04/2017
 * Time: 20:37
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;


/**
 * Class AppModel
 * @package App
 */
abstract class AppModel extends Model
{
    /**
     * Get database table name of model.
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }


    /**
     * Associate model meta-keywords.
     *
     * @param Model $model
     * @param string $keywordsColumn The column where the model's keywords are stored.
     * @param string $keywordRelationName The model's relation which associates itself with keywords.
     * @param array $keywords The keywords to associate with the model.
     */
    public function attachKeywords(Model $model, $keywordsColumn, $keywordRelationName, array $keywords){

        if(!empty($model) && !empty($keywordsColumn) && !empty($keywordRelationName)){
            if(
                Schema::hasColumn(self::getTableName(), $keywordsColumn) &&
                method_exists($model, $keywordRelationName) &&
                !empty($keywords))
            {
                for($i = 0; $i < count($keywords); $i++){
                    if(!empty($keywords[$i])){
                        if(
                            empty(Keyword::where('keyword', trim($keywords[$i]))->first()) &&
                            empty(Keyword::where('keyword', ucfirst(trim($keywords[$i])))->first()) &&
                            empty(Keyword::where('keyword', lcfirst(trim($keywords[$i])))->first()) &&
                            empty(Keyword::where('keyword', ucwords(trim($keywords[$i])))->first()) &&
                            empty(Keyword::where('keyword', strtolower(trim($keywords[$i])))->first())
                        ){
                            $keyword = new Keyword;
                            $keyword->keyword = trim($keywords[$i]);
                            $keyword->save();

                            if(empty($model->$keywordRelationName()->where('keyword_id', '=', $keyword->id)->first())){
                                $model->$keywordRelationName()->attach($keyword->id);
                            }
                        }
                        else {
                            $keyword = Keyword::where('keyword', trim($keywords[$i]))->first();

                            if(empty($model->$keywordRelationName()->where('keyword_id', '=', $keyword->id)->first())){
                                $model->$keywordRelationName()->attach($keyword->id);
                            }
                        }
                    }
                }
            }
        }
    }
}