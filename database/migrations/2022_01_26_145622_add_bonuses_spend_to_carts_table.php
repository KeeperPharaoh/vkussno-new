<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\CartContract;

class AddBonusesSpendToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CartContract::TABLE, function (Blueprint $table) {
            $table->string(CartContract::BONUSES_SPEND)->nullable();
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
            $table->dropColumn(CartContract::BONUSES_SPEND);
        });
    }
}
