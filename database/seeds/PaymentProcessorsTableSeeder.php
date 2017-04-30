<?php
use App\Helpers\WebsiteMeta\WebsiteMeta;
use App\PaymentProcessor;

/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 03-Mar-2015
 * Time: 13:41
 */

class PaymentProcessorsTableSeeder extends BaseSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->csv_to_array(base_path() . '/database/seeds/csv_files/payment_processors.csv');

        foreach ($data as $d) {
            try {
                $payment_processor = new PaymentProcessor([
                    'name' => $d['name'],
                    'url' => $d['url'],
                    'meta_title' => $d['meta_title'],
                    'meta_description' => $d['meta_description'],
                    'meta_keywords' => $d['meta_keywords']
                ]);

                $payment_processor->save();

                $keywords = explode(',', $d['meta_keywords']);
                $payment_processor->attachKeywords(
                    $payment_processor,
                    'meta_keywords',
                    'keywords',
                    $keywords
                );
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        }
    }
}
