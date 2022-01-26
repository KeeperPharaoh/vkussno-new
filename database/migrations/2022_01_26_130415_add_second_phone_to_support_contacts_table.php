<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\SupportContactContract;
class AddSecondPhoneToSupportContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(SupportContactContract::TABLE, function (Blueprint $table) {
            $table->string(SupportContactContract::SECOND_PHONE)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('support_contacts', function (Blueprint $table) {
            $table->dropColumn(SupportContactContract::SECOND_PHONE);
        });
    }
}
