<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->longText('sections_descriptions')->nullable();
            $table->integer('section_id')->nullable();
            $table->longText('questions_descriptions')->nullable();
            $table->integer('question_id')->nullable();
            $table->string('is_for');
            $table->foreign('category_id', 'category_fk_993713')->references('id')->on('categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
