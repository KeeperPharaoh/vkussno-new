<?php

use App\Domain\Contracts\ContentContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ContentContract::SLIDER_TABLE, function (Blueprint $table) {
            $table->id();
            $table
                ->string(ContentContract::SLIDER_TITLE)
                ->nullable()
            ;
            $table
                ->string(ContentContract::SLIDER_SUBTITLE)
                ->nullable()
            ;
            $table
                ->integer(ContentContract::SLIDER_PRICE)
                ->nullable()
            ;
            $table
                ->integer(ContentContract::SLIDER_OLD_PRICE)
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
