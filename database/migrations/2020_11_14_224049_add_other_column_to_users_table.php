<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('phone');
            $table->string('country');
            $table->string('state');
            $table->string('company_name');
            $table->string('designation');
            $table->string('industry');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('phone');
            $table->dropColumn('country');
            $table->dropColumn('state');
            $table->dropColumn('company_name');
            $table->dropColumn('designation');
            $table->dropColumn('industry');
        });
    }
}
