<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Domain\Contracts\CartContract;
use App\Domain\Contracts\PaymentTypeContract;
use App\Domain\Contracts\OrderStatusContract;

class AddPaymentStatusToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CartContract::TABLE, function (Blueprint $table) {
            $table
                ->unsignedBigInteger(CartContract::PAYMENT_TYPE)
                ->nullable();
            $table->foreign(CartContract::PAYMENT_TYPE)
                  ->references('id')
                  ->on(PaymentTypeContract::TABLE)
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
            ;
            $table->string(CartContract::PAYMENT_STATUS);

            $table
                ->unsignedBigInteger(CartContract::ORDER_STATUS)
                ->nullable();
            $table->foreign(CartContract::ORDER_STATUS)
                  ->references('id')
                  ->on(OrderStatusContract::TABLE)
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
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
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(CartContract::PAYMENT_TYPE);
            $table->dropColumn(CartContract::PAYMENT_STATUS);
            $table->dropColumn(CartContract::ORDER_STATUS);
        });
    }
}
