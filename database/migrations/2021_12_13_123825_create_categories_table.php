<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\CategoryContract;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create(CategoryContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger(CategoryContract::PARENT_ID)
                ->nullable()
            ;
            $table->foreign(CategoryContract::PARENT_ID)
                  ->references('id')
                  ->on(CategoryContract::TABLE)
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
            ;
            $table
                ->string(CategoryContract::TITLE)
            ;
            $table
                ->string(CategoryContract::IMAGE)
            ;
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists(CategoryContract::TABLE);
    }
}
