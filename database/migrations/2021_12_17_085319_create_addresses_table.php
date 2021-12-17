<?php

use App\Domain\Contracts\AddressContract;
use App\Domain\Contracts\UserContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AddressContract::TABLE, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger(AddressContract::USER_ID);
            $table->foreign(AddressContract::USER_ID)
                ->references('id')
                ->on(UserContract::TABLE)
                ->onUpdate('cascade')
                ->onDelete('cascade')
            ;

            $table->string(AddressContract::ADDRESS);
            $table->string(AddressContract::APARTMENT);
            $table->string(AddressContract::ENTRANCE);
            $table->string(AddressContract::FLOOR);
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
        Schema::dropIfExists('addresses');
    }
}
