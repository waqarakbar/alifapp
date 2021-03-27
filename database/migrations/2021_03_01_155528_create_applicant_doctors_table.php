<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_doctors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('applicant_id')->unsigned();
            $table->text('major_surgeries')->nullable();
            $table->text('medications')->nullable();
            $table->string('doctor_name', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('applicant_doctors', function (Blueprint $table){
            $table->foreign('applicant_id')->references('id')->on('applicants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_doctors');
    }
}
