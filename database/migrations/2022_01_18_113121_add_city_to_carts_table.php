<?php

use App\Domain\Contracts\CartContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CartContract::TABLE, function (Blueprint $table) {
            $table->string(CartContract::CITY);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(CartContract::TABLE, function (Blueprint $table) {
            $table->dropColumn(CartContract::CITY);
        });
    }
}
