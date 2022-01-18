<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\CityContract;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CityContract::TABLE, function (Blueprint $table) {
            Schema::dropIfExists('cities');
            Schema::dropIfExists('deliveries');
            $table->id();
            $table->string(CityContract::CITY);
            $table->integer(CityContract::PRICE);
            $table->integer(CityContract::FREE);
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
        Schema::dropIfExists('cities');
    }
}
