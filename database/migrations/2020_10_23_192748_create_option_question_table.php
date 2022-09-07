<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_question', function (Blueprint $table) {
            //
            $table->unsignedInteger('question_id');
            $table->foreign('question_id', 'question_id_fk_773691')->references('id')->on('questions')->onDelete('cascade');

            $table->unsignedInteger('option_id');
            $table->foreign('option_id', 'option_id_fk_773691')->references('id')->on('options')->onDelete('cascade');
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
        Schema::drop('option_question');
    }
}
