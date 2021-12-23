<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\ProductContract;

class AddCheckboxCategoriesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(ProductContract::TABLE, function (Blueprint $table) {
            $table
                ->boolean(ProductContract::PROMOTIONAL)
                ->default(false)
            ;
            $table
                ->boolean(ProductContract::NEW)
                ->default(false)
            ;
            $table
                ->boolean(ProductContract::RECOMMENDED)
                ->default(false)
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
            //
        });
    }
}
