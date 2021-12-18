<?php

use App\Domain\Contracts\ProductContract;
use App\Domain\Contracts\SpecialCategoriesContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SpecialCategoriesContract::STOCK_TABLE, function (Blueprint $table) {
            $table->id();

            $table->string(SpecialCategoriesContract::TITLE);

            $table
                ->unsignedBigInteger(SpecialCategoriesContract::PRODUCT_ID)
            ;
            $table->foreign(SpecialCategoriesContract::PRODUCT_ID)
                  ->references('id')
                  ->on(ProductContract::TABLE)
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
            ;

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
        Schema::dropIfExists('stock_categories');
    }
}
