<?php

use App\Domain\Contracts\CartContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CartContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->integer(CartContract::USER);
            $table->integer(CartContract::SUM);
            $table->string(CartContract::STATUS);
            $table->string(CartContract::PHONE,15);
            $table->string(CartContract::ADDRESS);
            $table->string(CartContract::ENTRANCE);
            $table->string(CartContract::FLOOR);
            $table->string(CartContract::APARTMENT);
            $table->time(CartContract::TIME);
            $table->string(CartContract::COMMENT,600);
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
        Schema::dropIfExists('carts');
    }
}
