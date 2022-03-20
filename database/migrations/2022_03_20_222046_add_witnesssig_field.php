<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWitnesssigField extends Migration
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
            $table->string('witness_signature_path');
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
            $table->dropColumn('witness_signature_path');
        });
    }
}
