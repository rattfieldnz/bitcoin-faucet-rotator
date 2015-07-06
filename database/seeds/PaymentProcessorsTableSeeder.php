<?php
use App\PaymentProcessor;

/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 03-Mar-2015
 * Time: 13:41
 */

class PaymentProcessorsTableSeeder extends BaseSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->csv_to_array(base_path() . '/database/seeds/csv_files/payment_processors.csv');

        foreach($data as $d) {
            $payment_processor = new PaymentProcessor([
                'name' => $d['name'],
                'url' => $d['url'],
            ]);

            $payment_processor->save();
        }
    }

}