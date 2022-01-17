<?php

use App\Domain\Contracts\TimeOfDeliveryContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlockToTimeOfDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_of_deliveries', function (Blueprint $table) {
            $table->boolean(TimeOfDeliveryContract::BLOCK)
            ->default(false);
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
            $table->dropColumn(TimeOfDeliveryContract::BLOCK);
        });
    }
}
