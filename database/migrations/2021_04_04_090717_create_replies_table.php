<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('discuss.replies.table_name'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(config('discuss.replies.thread_key'));
            $table->boolean('anonymous')->default(false);
            $table->text('body');
            $table->morphs(config('discuss.replies.user_morph_key'));
            $table->timestamps();

            $table->foreign(config('discuss.replies.thread_key'))
              ->references('id')
              ->on(config('discuss.threads.table_name'))
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
        Schema::dropIfExists('replies');
    }
}
