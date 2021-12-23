<?php

use App\Domain\Contracts\OrderContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(OrderContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(OrderContract::PRODUCT_ID);
            $table->integer(OrderContract::QUANTITY);
            $table->integer(OrderContract::CART_ID);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
