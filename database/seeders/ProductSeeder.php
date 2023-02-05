<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Ao thun',
                'price' => '30000',
            ],
            [
                'name' => 'Ao 3 lo',
                'price' => '30000',
            ],
            [
                'name' => 'Ao dai',
                'price' => '30000',
            ],
            
        ]);
    }
}
