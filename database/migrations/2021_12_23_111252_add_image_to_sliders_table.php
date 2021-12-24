<?php

use App\Domain\Contracts\SliderContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(SliderContract::TABLE, function (Blueprint $table) {
            $table
                ->string(SliderContract::IMAGE)
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
        Schema::table('sliders', function (Blueprint $table) {
            $table
                ->dropColumn(SliderContract::IMAGE);
        });
    }
}
