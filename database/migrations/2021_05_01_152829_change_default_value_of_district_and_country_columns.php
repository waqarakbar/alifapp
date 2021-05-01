<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultValueOfDistrictAndCountryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->bigInteger('district_id')->unsigned()->nullable()->change();
            $table->bigInteger('country_id')->unsigned()->nullable()->change();
            $table->bigInteger('father_district_id')->unsigned()->nullable()->change();
            $table->bigInteger('father_country_id')->unsigned()->nullable()->change();
            $table->bigInteger('mother_district_id')->unsigned()->nullable()->change();
            $table->bigInteger('mother_country_id')->unsigned()->nullable()->change();
            $table->bigInteger('mother_province_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
