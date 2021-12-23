<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Domain\Contracts\BenefitsContract;

class CreateBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BenefitsContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table
                ->string(BenefitsContract::IMAGE)
                ->nullable()
            ;
            $table
                ->string(BenefitsContract::DESCRIPTION)
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
