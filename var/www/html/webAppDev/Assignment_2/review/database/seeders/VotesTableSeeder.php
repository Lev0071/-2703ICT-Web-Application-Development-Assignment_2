<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votes')->insert([
            'vote' => 1,
            'user_id' => 3,
            'review_id' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 0,
            'user_id' => 2,
            'review_id' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        // All for review ID 1
        DB::table('votes')->insert([
            'vote' => 0,
            'user_id' => 7,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 0,
            'user_id' => 6,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 0,
            'user_id' => 5,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 1,
            'user_id' => 4,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 1,
            'user_id' => 3,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 1,
            'user_id' => 2,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('votes')->insert([
            'vote' => 1,
            'user_id' => 1,
            'review_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        // Review ID: 3
        DB::table('votes')->insert([
            'vote' => 0,
            'user_id' => 1,
            'review_id' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('votes')->insert([
            'vote' => 0,
            'user_id' => 3,
            'review_id' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('votes')->insert([
            'vote' => 1,
            'user_id' => 4,
            'review_id' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
