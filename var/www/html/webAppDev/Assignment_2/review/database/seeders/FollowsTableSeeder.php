<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            'user_id' => 1,
            'following' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('follows')->insert([
            'user_id' => 3,
            'following' => 4,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('follows')->insert([
            'user_id' => 5,
            'following' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('follows')->insert([
            'user_id' => 6,
            'following' => 5,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('follows')->insert([
            'user_id' => 6,
            'following' => 7,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
    }
}
