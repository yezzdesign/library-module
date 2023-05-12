<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('post_id')->nullable();
            $table->string('title');
            $table->text('blurb')->nullable();
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->boolean('active_state')->nullable()->default(false);
            $table->date('read_date')->nullable();
            $table->integer('pages')->nullable();
            $table->string('genre')->nullable();

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
        Schema::dropIfExists('books');
    }
};
