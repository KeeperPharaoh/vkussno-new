<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Domain\Contracts\ContentContract;

class CreateBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ContentContract::BENEFITS_TABLE, function (Blueprint $table) {
            $table->id();
            $table
                ->string(ContentContract::BENEFITS_IMAGE)
                ->nullable()
            ;
            $table
                ->string(ContentContract::BENEFITS_DESCRIPTION)
                ->nullable()
            ;
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
        Schema::dropIfExists('benefits');
    }
}
