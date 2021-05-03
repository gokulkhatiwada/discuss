<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('discuss.threads.table_name'), function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('title');
            $table->text('text')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger(config('discuss.threads.category_key'))->nullable();
            $table->nullableMorphs(config('discuss.threads.user_morph_key'));
            $table->boolean('anonymous')->default(false);
            $table->integer('views')->default(0);
            $table->boolean('closed')->default(false);
            $table->timestamp('last_reply_at')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(config('discuss.threads.category_key'))
              ->references('id')
              ->on(config('discuss.categories.table_name'))
              ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
