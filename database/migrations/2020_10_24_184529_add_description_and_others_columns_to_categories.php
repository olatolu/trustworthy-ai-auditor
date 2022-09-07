<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionAndOthersColumnsToCategories extends Migration
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
            $table->longText('description')->nullable();
            $table->text('sections_headings')->nullable();
            $table->string('slug'); // Field name same as your `saveSlugsTo`
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->integer('is_active')->default(0);
            $table->integer('test_duration')->default(0);
            $table->string('style');
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
            $table->dropColumn('description');
            $table->dropColumn('sections_headings');
            $table->dropColumn('slug');
            $table->dropColumn('start_at');
            $table->dropColumn('end_at');
            $table->dropColumn('test_duration');
            $table->dropColumn('style');
            $table->dropColumn('is_active');
        });
    }
}
