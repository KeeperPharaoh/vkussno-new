<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\TimeOfDeliveryContract;

class CreateTimeOfDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TimeOfDeliveryContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->time(TimeOfDeliveryContract::BEGINNING_TIME);
            $table->time(TimeOfDeliveryContract::END_TIME);
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
        Schema::dropIfExists('time_of_deliveries');
    }
}
