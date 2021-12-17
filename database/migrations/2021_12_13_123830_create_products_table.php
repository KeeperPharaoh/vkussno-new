<?php

use App\Domain\Contracts\CategoryContract;
use App\Domain\Contracts\SubcategoryContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\ProductContract;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create(ProductContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger(ProductContract::SUBCATEGORY_ID)
                ->nullable();
            $table->foreign(ProductContract::SUBCATEGORY_ID)
                  ->references('id')
                  ->on(CategoryContract::TABLE)
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
            ;
            $table
                ->string(ProductContract::TITLE)
            ;
            $table
                ->string(ProductContract::IMAGE)
            ;
            $table
                ->text(ProductContract::DESCRIPTION)
            ;
            $table
                ->integer(ProductContract::PRICE)
            ;
            $table
                ->integer(ProductContract::OLD_PRICE)
                ->nullable();
            ;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists(ProductContract::TABLE);
    }
}
