<?php

use App\MainMeta;
use Illuminate\Database\Seeder;

/**
 * Class MainMetaTableSeeder
 */
class MainMetaTableSeeder extends BaseSeeder
{
    public function run()
    {
        $data = $this->csv_to_array(base_path() . '/database/seeds/csv_files/main_meta.csv');

        foreach ($data as $d) {
            try {
                $mainMeta = new MainMeta([
                    'title' => $d['title'],
                    'description' => $d['description'],
                    'keywords' => $d['keywords'],
                    'google_analytics_id' => "",
                    'yandex_verification' => "",
                    'bing_verification' => "",
                    'page_main_title' => $d['page_main_title'],
                    'page_main_content' => $d['page_main_content'],
                    'addthisid' => "",
                    'twitter_username' => "",
                    'feedburner_feed_url' => "",
                    'disqus_shortname' => "",
                    'prevent_adblock_blocking' => true
                ]);

                $mainMeta->save();
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        }
    }
}
