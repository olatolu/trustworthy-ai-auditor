<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTookitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tookits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->year('year');
            $table->string('industry');
            $table->string('location');
            $table->string('price');
            $table->string('organization_size');
            $table->float('tqg_tc')->nullable();
            $table->float('tqg_le')->nullable();
            $table->float('tqg_over_all')->nullable();
            $table->float('previous_tqg_over_all')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('tookits');
    }
}
