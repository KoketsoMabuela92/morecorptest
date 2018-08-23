<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsBids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::connection('mysql')->hasTable('product_bids')) {
            Schema::connection('mysql')
                ->create(
                    'product_bids',
                    function (Blueprint $table) {
                        $table->integer('id')->autoIncrement();
                        $table->integer('productId');
                        $table->float('highestBid')->default(0.00);
                        $table->float('lowestBid')->default(0.00);
                        $table->float('averageBid')->default(0.00);
                        $table->integer('bidCount')->default(0);
                        $table->timestamps();
                        $table->foreign('productId')->references('id')->on('products');
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
        Schema::connection('mysql')->dropIfExists('product_bids');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
