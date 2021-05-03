<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnParentKeyToRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('discuss.replies.table_name'), function (Blueprint $table) {
          $table->unsignedBigInteger(config('discuss.replies.parent_reply_key'))->nullable();

          $table->foreign(config('discuss.replies.parent_reply_key'))
              ->references('id')
              ->on(config('discuss.replies.table_name'))
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
        Schema::table(config('discuss.replies.table_name'), function (Blueprint $table) {
            $table->dropColumn(config('discuss.replies.parent_reply_key'));
        });
    }
}
