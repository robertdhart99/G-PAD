<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAssetsTable2 extends Migration
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
            $table->boolean('CNWDI');
            $table->boolean('NATO');
            $table->boolean('OTHER');
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
            $table->dropColumn('CNWDI', 'NATO', 'OTHER');
        });
    }
}
