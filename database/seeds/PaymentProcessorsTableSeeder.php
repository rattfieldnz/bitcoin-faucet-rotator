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
            $url = $d['url'];
            try {
                $meta = new WebsiteMeta($url);
                $payment_processor = new PaymentProcessor([
                    'name' => $d['name'],
                    'url' => $url,
                    'meta_title' => $meta->title(),
                    'meta_description' => $meta->description(),
                    'meta_keywords' => $meta->keywords(),
                ]);

                $payment_processor->save();
            } catch (Exception $e) {
                error_log($e->getMessage() . "<br>" . 'The URL "' . $url . '" does not exist or is experiencing technical issues.');
            }
        }
    }
}
