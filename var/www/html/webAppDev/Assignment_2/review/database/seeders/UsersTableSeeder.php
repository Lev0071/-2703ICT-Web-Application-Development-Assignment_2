<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Moderator",
            'email' => 'Moderator@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Moderator',
        ]);

        DB::table('users')->insert([
            'name' => "Chris",
            'email' => 'Chris@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Moderator',
        ]);

        DB::table('users')->insert([
            'name' => "Member",
            'email' => 'Member@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Member',
        ]);

        DB::table('users')->insert([
            'name' => "Cara",
            'email' => 'Cara@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Member',
        ]);

        DB::table('users')->insert([
            'name' => "Bob",
            'email' => 'Bob@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Member',
        ]);

        DB::table('users')->insert([
            'name' => "Fred",
            'email' => 'Fred@a.org',
            'password' => bcrypt('1234'),
            'type' => 'Member',
        ]);

        DB::table('users')->insert([
            'name' => "Sedat",
            'email' => 's@p.com',
            'password' => bcrypt('1234'),
            'type' => 'Moderator',
        ]);
    }
}
