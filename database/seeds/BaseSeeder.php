<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 02-Mar-2015
 * Time: 22:39
 */

class BaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }

    /**
     * Function to convert csv data into an
     * associative array. Sourced from
     * http://pastebin.com/LtmGzpxF
     * @param $filename
     * @param string $delimiter
     * @return array|bool
     */
    protected function csv_to_array($filename, $delimiter = ',')
    {
        // If the file doesn't exist, or isn't readable,
        // return false. The seeding will fail at this point.
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
        // While there are still rows in the file
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            // Below conditional forms the associated array,
                // filling each array within with data from each
                // row.
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            // Close access to the file.
            fclose($handle);
        }
        return $data;
    }

    protected function insert_data($table_name, array $data)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table($table_name)->truncate();
        DB::table($table_name)->insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
