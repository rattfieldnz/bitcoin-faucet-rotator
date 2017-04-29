<?php

use App\AdBlock;
use App\User;
use Illuminate\Database\Seeder;;

/**
 * Class AdBlockSeeder
 */
class AdBlockSeeder extends BaseSeeder
{
    public function run()
    {
        $data = $this->csv_to_array(base_path() . '/database/seeds/csv_files/ad_block.csv');

        foreach ($data as $d) {
            try {
                $adBlock = new AdBlock([
                    'ad_content' => $d['ad_content'],
                    'user_id' => (int)User::where('is_admin', '=', true)->firstOrFail()->id
                ]);

                $adBlock->save();
            } catch (Exception $e) {
                error_log($e->getMessage() . "<br>" . 'The adblock did not save sucessfully, please check error logs for more information.');
            }
        }
    }
}
