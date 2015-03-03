<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 03-Mar-2015
 * Time: 18:56
 */

class FaucetPaymentProcessorsTableSeeder extends BaseSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->csv_to_array(base_path() . '/database/seeds/csv_files/faucets_payment_processors.csv');
        $this->insert_data('faucet_payment_processor', $data);
    }

}