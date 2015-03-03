<?php
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
        $this->insert_data('payment_processors', $data);
    }

}