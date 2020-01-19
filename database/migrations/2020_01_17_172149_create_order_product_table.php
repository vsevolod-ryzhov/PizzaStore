<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('order_id')->nullable(false);
            $table->unsignedInteger('product_id')->nullable(false);
            $table->unsignedSmallInteger('count');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->index(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
