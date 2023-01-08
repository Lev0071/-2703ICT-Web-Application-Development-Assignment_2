<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'review' => "Nice product",
            'user_id' => 1,
            'product_id' => 3,
            'rating' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('reviews')->insert([
            'review' => "I recomend",
            'user_id' => 5,
            'product_id' => 2,
            'rating' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('reviews')->insert([
            'review' => "Not bad",
            'user_id' => 6,
            'product_id' => 4,
            'rating' => 3,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
