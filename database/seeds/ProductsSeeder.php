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
            'id' => 1,
            'name' => 'Cellphone X',
            'sku' => '1111111111',
            'price' => 2000,
            'description' => 'Cellphone X test description',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'id' => 2,
            'name' => 'Cellphone Y',
            'sku' => '2222222222',
            'price' => 6000,
            'description' => 'Cellphone Y test description',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection('mysql')->table('products')->insert([
            'id' => 3,
            'name' => 'Cellphone Z',
            'sku' => '3333331',
            'price' => 2000,
            'description' => 'Cellphone Z test description',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
