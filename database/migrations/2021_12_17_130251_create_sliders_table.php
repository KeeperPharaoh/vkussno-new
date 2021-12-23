<?php

use App\Domain\Contracts\BenefitsContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\SliderContract;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SliderContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table
                ->string(SliderContract::TITLE)
                ->nullable()
            ;
            $table
                ->string(SliderContract::SUBTITLE)
                ->nullable()
            ;
            $table
                ->string(SliderContract::IMAGE)
            ;
            $table
                ->integer(SliderContract::PRICE)
                ->nullable()
            ;
            $table
                ->integer(SliderContract::OLD_PRICE)
                ->nullable()
            ;
            $table
                ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
