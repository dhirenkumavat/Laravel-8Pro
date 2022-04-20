<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {

            DB::table('Post')->insert([
                'title' => 'John Doe'.$i,
                'description' =>'Ultimately the above command generated the seeder in the'.$i
            ]);
        }
    }
}
