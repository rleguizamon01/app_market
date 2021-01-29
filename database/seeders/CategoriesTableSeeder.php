<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<15;$i++){
            DB::table('categories')->insert([
                'name' => 'Category'.$i,
            ]);
        }
    }
}
