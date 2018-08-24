<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $date = Carbon::now()->toDateTimeString();

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone X',
            'sku' => '1111111111',
            'price' => 2000,
            'description' => 'Cellphone X test description',
            'fullPath' => 'product_pictures/1.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'highestBid' => 0.00,
            'lowestBid' => 0.00,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone Y',
            'sku' => '2222222222',
            'price' => 6000,
            'description' => 'Cellphone Y test description',
            'fullPath' => 'product_pictures/2.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'highestBid' => 0.00,
            'lowestBid' => 0.00,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone Z',
            'sku' => '3333331',
            'price' => 2000,
            'description' => 'Cellphone Z test description',
            'fullPath' => 'product_pictures/3.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'highestBid' => 0.00,
            'lowestBid' => 0.00,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone A',
            'sku' => '666666666666',
            'price' => 6000,
            'description' => 'Cellphone A test description',
            'fullPath' => 'product_pictures/2.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'highestBid' => 0.00,
            'lowestBid' => 0.00,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone B',
            'sku' => '55555555555555',
            'price' => 2000,
            'description' => 'Cellphone B test description',
            'fullPath' => 'product_pictures/3.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'highestBid' => 0.00,
            'lowestBid' => 0.00,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
