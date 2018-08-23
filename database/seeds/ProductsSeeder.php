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
            'fullPath' => '/var/www/html/more_corp_test/product_pictures/1.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone Y',
            'sku' => '2222222222',
            'price' => 6000,
            'description' => 'Cellphone Y test description',
            'fullPath' => '/var/www/html/more_corp_test/product_pictures/2.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'name' => 'Cellphone Z',
            'sku' => '3333331',
            'price' => 2000,
            'description' => 'Cellphone Z test description',
            'fullPath' => '/var/www/html/more_corp_test/product_pictures/3.png',
            'mimeType' => 'png',
            'viewCount' => 0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
