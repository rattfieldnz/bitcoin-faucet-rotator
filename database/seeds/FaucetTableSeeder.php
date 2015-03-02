<?php
/**
 * This class will seed the 'faucets' table
 * with faucets.
 */

use Flynsarmy\CsvSeeder\CsvSeeder;

class FaucetTableSeeder extends CsvSeeder{

    public function __construct()
    {
        $this->table = 'faucets';
        $this->filename = app_path() . '/database/seeds/faucets.csv';
    }

    public function run()
    {
        DB::table($this->table)->truncate();

        parent::run();
    }

}