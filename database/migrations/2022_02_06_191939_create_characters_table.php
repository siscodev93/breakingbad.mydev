<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('char_id');
            $table->string('name');
            $table->string('birthday')->nullable();
            $table->string('img', 1000);
            $table->json('occupations');
            $table->string('status');
            $table->string('nickname');
            $table->string('category');
            $table->string('portrayed');
            $table->json('better_call_saul_appearance');
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
        Schema::dropIfExists('characters');
    }
}
