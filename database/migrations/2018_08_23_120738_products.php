<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (!Schema::connection('mysql')->hasTable('products')) {
            Schema::connection('mysql')
                ->create(
                    'products',
                    function (Blueprint $table) {
                        $table->integer('id')->autoIncrement();
                        $table->string('name',50);
                        $table->string('sku',50)->unique();
                        $table->double('price');
                        $table->string('description', 50);
                        $table->string('fullPath');
                        $table->string('mimeType');
                        $table->integer('viewCount')->default(0);
                        $table->timestamps();
                    }
                );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::connection('mysql')->dropIfExists('products');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
