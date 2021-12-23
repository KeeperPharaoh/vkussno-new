<?php

use App\Domain\Contracts\DeliveryContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DeliveryContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(DeliveryContract::CITY);
            $table->integer(DeliveryContract::PRICE);
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
        Schema::dropIfExists('deliveries');
    }
}
