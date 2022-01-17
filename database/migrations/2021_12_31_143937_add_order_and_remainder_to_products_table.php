<?php

use App\Domain\Contracts\ProductContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderAndRemainderToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger(ProductContract::ORDER)
                  ->nullable()
            ;
            $table->integer(ProductContract::REMAINDER)
                  ->default(0)
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(ProductContract::ORDER);
            $table->dropColumn(ProductContract::REMAINDER);
        });
    }
}
