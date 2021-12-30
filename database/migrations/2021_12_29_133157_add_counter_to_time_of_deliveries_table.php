<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\TimeOfDeliveryContract;

class AddCounterToTimeOfDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_of_deliveries', function (Blueprint $table) {
            $table->integer(TimeOfDeliveryContract::COUNTER)->nullable();
            $table->integer(TimeOfDeliveryContract::MAX_COUNTER)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_of_deliveries', function (Blueprint $table) {
            $table->dropColumn(TimeOfDeliveryContract::MAX_COUNTER);
            $table->dropColumn(TimeOfDeliveryContract::COUNTER);
        });
    }
}
