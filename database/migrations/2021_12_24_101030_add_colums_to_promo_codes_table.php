<?php

use App\Domain\Contracts\ProductContract;
use App\Domain\Contracts\PromoCodeContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToPromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(PromoCodeContract::TABLE, function (Blueprint $table) {
            $table->float(PromoCodeContract::PERCENT);

            $table
                ->unsignedBigInteger(PromoCodeContract::FIRST_BONUS)
                ->nullable()
            ;
            $table->foreign(PromoCodeContract::FIRST_BONUS)
                  ->references('id')
                  ->on(ProductContract::TABLE)
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
            ;

            $table
                ->unsignedBigInteger(PromoCodeContract::SECOND_BONUS)
                ->nullable()
            ;
            $table->foreign(PromoCodeContract::SECOND_BONUS)
                  ->references('id')
                  ->on(ProductContract::TABLE)
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
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->dropColumn(PromoCodeContract::PERCENT);
            $table->dropColumn(PromoCodeContract::FIRST_BONUS);
            $table->dropColumn(PromoCodeContract::SECOND_BONUS);

        });
    }
}
