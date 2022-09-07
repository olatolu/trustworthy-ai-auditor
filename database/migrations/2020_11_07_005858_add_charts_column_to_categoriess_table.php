<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChartsColumnToCategoriessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->integer('radar_chart')->nullable();
            $table->integer('bar_chart')->nullable();
            $table->integer('bar_chart_section')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->dropColumn('radar_chart');
            $table->dropColumn('bar_chart');
            $table->dropColumn('bar_chart_section');
        });
    }
}
