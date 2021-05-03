<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnParentKeyToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('discuss.categories.table_name'), function (Blueprint $table) {
          $table->unsignedBigInteger(config('discuss.categories.parent_key'))->nullable();

          $table->foreign(config('discuss.categories.parent_key'))
              ->references('id')
              ->on(config('discuss.categories.table_name'))
              ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('discuss.categories.table_name'), function (Blueprint $table) {
            $table->dropColumn(config('discuss.categories.parent_key'));
        });
    }
}
