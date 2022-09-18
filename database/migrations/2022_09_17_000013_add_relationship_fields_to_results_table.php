<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResultsTable extends Migration
{
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedInteger('profile_id');

            $table->foreign('profile_id', 'profile_fk_773785')->references('id')->on('profiles');
        });
    }
}
