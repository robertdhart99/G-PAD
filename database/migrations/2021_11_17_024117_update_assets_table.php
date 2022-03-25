<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Update the assets table
        Schema::table('assets', function ($table) {
            $table->string('classified_by')->nullable();
            $table->string('derived_from')->nullable();
            $table->string('classificationlevel')->nullable();
            $table->string('declassification_date');
            $table->string('signature_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Update the assets table
        Schema::table('assets', function ($table) {
            $table->dropColumn('classified_by', 'derived_from', 'classificationlevel', 'declassification_date', 'signature_path');
        });
    }
}
