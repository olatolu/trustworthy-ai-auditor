<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewkitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newkits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->bigInteger('toolkit_id')->nullable();
            $table->string('name')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('country')->nullable();
            $table->date('release_date')->nullable();
            $table->string('source_url')->nullable();
            $table->longText('description')->nullable();
            $table->string('attachment')->nullable();
            $table->string('profile_id');
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
        Schema::dropIfExists('newkits');
    }
}
