<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<15;$i++){
            DB::table('apps')->insert([
                'name' => 'App'.$i,
                'price' => $i*83,
                'category' => 'Category'.$i,
                'developer_id' => $i,
                'photo' => '',
            ]);
        }
    }
}
