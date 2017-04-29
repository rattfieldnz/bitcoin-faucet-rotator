<?php

use App\Faucet;
use App\Keyword;
use Illuminate\Database\Seeder;

/**
 * Class KeywordTableSeeder
 */
class KeywordTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('faucets_keywords')->truncate();
        DB::table('keywords')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $faucets = Faucet::all();

        foreach($faucets as $f){

            //dd($f->keywords());
            $keywordString = $f->meta_keywords;
            $keywords = explode(',', $keywordString);

            for($i = 0; $i < count($keywords); $i++){
                if(!empty($keywords[$i])){
                    if(
                        empty(Keyword::where('keyword', trim($keywords[$i]))->first()) &&
                        empty(Keyword::where('keyword', ucfirst(trim($keywords[$i])))->first()) &&
                        empty(Keyword::where('keyword', lcfirst(trim($keywords[$i])))->first()) &&
                        empty(Keyword::where('keyword', ucwords(trim($keywords[$i])))->first()) &&
                        empty(Keyword::where('keyword', strtolower(trim($keywords[$i])))->first())
                    ){
                        //echo trim($keywords[$i]) . "\n";
                        $keyword = new Keyword;
                        $keyword->keyword = trim($keywords[$i]);
                        $keyword->save();

                        if(empty($f->keywords()->where('keyword_id', '=', $keyword->id)->first())){
                            $f->keywords()->attach($keyword->id);
                        }
                    }
                    else {
                        $keyword = Keyword::where('keyword', trim($keywords[$i]))->first();

                        if(empty($f->keywords()->where('keyword_id', '=', $keyword->id)->first())){
                            $f->keywords()->attach($keyword->id);
                        }
                    }
                }
            }
        }
    }
}
