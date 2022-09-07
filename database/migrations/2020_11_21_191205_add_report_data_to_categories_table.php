<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportDataToCategoriesTable extends Migration
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
            $table->longText('radar_report_header')->nullable();
            $table->longText('radar_report_footer')->nullable();
            $table->longText('bar_report_header')->nullable();
            $table->longText('bar_report_footer')->nullable();


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
            $table->dropColumn('radar_report_header');
            $table->dropColumn('radar_report_footer');
            $table->dropColumn('bar_report_header');
            $table->dropColumn('bar_report_footer');
        });
    }
}
