<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'iPhone 13',
            'price' => 6009,
            'manufacturer_id' => 1,
            'image' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-13-pro-max-graphite-select?wid=470&hei=556&fmt=png-alpha&.v=1631652956000',
            'description' => 'iPhone 13 features a cinema‑standard wide colour gamut, displaying colours just as filmmakers intended. And with precise colour accuracy, everything on the screen looks remarkably natural.',
            'url' => 'https://www.apple.com/au/iphone-13/',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('products') ->insert([
            'name' => 'Note 21',
            'price' => 5674,
            'manufacturer_id' => 2,
            'image' => 'https://cdn.shopify.com/s/files/1/0423/2750/7093/products/MysticBronze_d9a540a0-33e7-4506-a822-cd0d298ce3be.jpg?v=1626108488',
            'description' => 'Enjoy Galaxy Z Fold3 5G\'s unique ability to stand upright with Flex Mode.This symmetrical and balanced design unfolds the next era of smartphones.',
            'url' => 'https://www.samsung.com/au/smartphones/galaxy-z-fold3-5g/',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('products')->insert([
            'name' => 'Surface Pro',
            'price' => 1234,
            'manufacturer_id' => 3,
            'image' =>'https://cdn-o.fishpond.com.au/0160/166/583/1412902164/original.jpeg',
            'description' => 'Accomplish Your Goals on a Tool with Faster Connections and Extra Speed. Get the Incredibly Powerful and Versatile Device That Adapts to You.',
            'url' => 'https://www.microsoft.com/en-au/d/surface-pro-7/8n17j0m5zzqs',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('products')->insert([
            'name' => 'Google Pixel',
            'price' => 1000,
            'manufacturer_id' => 4,
            'image' => 'https://cdn.shopify.com/s/files/1/0423/2750/7093/products/google-pixel-5-Sorta-Sage_1.jpg?v=1626273486',
            'description' => 'Pixel is built the Google way, so it keeps getting more helpful with feature drops.3 New features and apps are frequently added through software boosts so that your Pixel gets better over time.',
            'url' => 'https://store.google.com/au/category/phones?hl=en-GB',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
 