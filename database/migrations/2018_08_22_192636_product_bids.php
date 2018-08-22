<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductBids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('mysql')->hasTable('product_bids')) {
            Schema::connection('mysql')
                ->create(
                    'product_bids',
                    function (Blueprint $table) {
                        $table->engine = 'InnoDB';
                        $table->charset = 'latin1';
                        $table->collation = 'latin1_swedish_ci';

                        $table->integer('id')->increments(1)->primary();
                        $table->foreign('productId')->references('products')->on('id');
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
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::connection('mysql')->dropIfExists('product_bids');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
