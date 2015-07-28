<?php
use App\Faucet;

/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 02-Mar-2015
 * Time: 22:38
 */

class FaucetsTableSeeder extends BaseSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->csv_to_array(base_path() . '/database/seeds/csv_files/faucets.csv');

        foreach($data as $d){
           $faucet = new Faucet([
                'name' => $d['name'],
                'url' => $d['url'],
                'interval_minutes' => (int)$d['interval_minutes'],
                'min_payout' => (int)$d['min_payout'],
                'max_payout' => (int)$d['max_payout'],
                'has_ref_program' => $d['has_ref_program'],
                'ref_payout_percent' => (int)$d['ref_payout_percent'],
                'comments' => $d['comments'],
                'is_paused' => $d['comments'],
            ]);

            $faucet->save();
        }
    }

}