<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            $table->string('form_number', 20)->nullable();
            $table->bigInteger('applying_grade_id')->unsigned(); //-- FK
            $table->bigInteger('section_id')->unsigned(); //-- FK
            $table->enum('need_transportation', ['yes', 'no'])->default('yes');
            $table->enum('how_hear_about_us', ['newspaper', 'television', 'internet', 'references'])->nullable();
            $table->string('source_name', 255)->nullable();
            $table->string('session', 100)->nullable();
            $table->string('name', 255)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('dob_words', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('pobox', 255)->nullable();
            $table->string('village', 255)->nullable();
            $table->string('tehsil', 255)->nullable();
            $table->bigInteger('district_id')->unsigned(); //-- FK
            $table->bigInteger('province_id')->unsigned(); //-- FK
            $table->bigInteger('country_id')->unsigned(); //-- FK
            $table->string('home_phone_number', 255)->nullable();
            $table->string('mobile_number', 255)->nullable();
            $table->string('email_address', 255)->nullable();

            $table->string('father_name', 255)->nullable();
            $table->string('father_cnic', 20)->nullable();
            $table->string('father_cast', 255)->nullable();
            $table->string('father_tribe', 255)->nullable();
            $table->string('father_occupation', 255)->nullable();
            $table->string('father_designation', 255)->nullable();
            $table->string('father_department', 255)->nullable();
            $table->string('father_pobox', 255)->nullable();
            $table->string('father_village', 255)->nullable();
            $table->string('father_tehsil', 255)->nullable();
            $table->bigInteger('father_district_id')->unsigned(); // FK
            $table->bigInteger('father_province_id')->unsigned(); // FK
            $table->bigInteger('father_country_id')->unsigned(); // FK
            $table->string('father_work_phone', 20)->nullable();
            $table->string('father_cell_phone', 20)->nullable();
            $table->string('father_email', 255)->nullable();

            $table->string('mother_name', 255)->nullable();
            $table->string('mother_cnic', 255)->nullable();
            $table->string('mother_cast', 255)->nullable();
            $table->string('mother_tribe', 255)->nullable();
            $table->string('mother_occupation', 255)->nullable();
            $table->string('mother_designation', 255)->nullable();
            $table->string('mother_department', 255)->nullable();
            $table->string('mother_pobox', 255)->nullable();
            $table->string('mother_village', 255)->nullable();
            $table->string('mother_tehsil', 255)->nullable();
            $table->bigInteger('mother_district_id')->unsigned(); // FK
            $table->bigInteger('mother_province_id')->unsigned(); // FK
            $table->bigInteger('mother_country_id')->unsigned(); // FK
            $table->string('mother_work_phone', 20)->nullable();
            $table->string('mother_cell_phone', 20)->nullable();
            $table->string('mother_email', 255)->nullable();

            $table->string('eme_name', 255)->nullable();
            $table->string('eme_cnic', 255)->nullable();
            $table->string('eme_cast', 255)->nullable();
            $table->string('eme_tribe', 255)->nullable();
            $table->string('eme_occupation', 255)->nullable();
            $table->string('eme_designation', 255)->nullable();
            $table->string('eme_department', 255)->nullable();
            $table->string('eme_pobox', 255)->nullable();
            $table->string('eme_village', 255)->nullable();
            $table->string('eme_tehsil', 255)->nullable();
            $table->bigInteger('eme_district_id')->unsigned()->nullable(); // FK
            $table->bigInteger('eme_province_id')->unsigned()->nullable(); // FK
            $table->bigInteger('eme_country_id')->unsigned()->nullable(); // FK
            $table->string('eme_work_phone', 20)->nullable();
            $table->string('eme_cell_phone', 20)->nullable();
            $table->string('eme_email', 255)->nullable();
            $table->text('photo')->nullable();



            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('applicants', function(Blueprint $table){
            $table->foreign('applying_grade_id')->references('id')->on('applying_grades');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('province_id')->references('id')->on('districts');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('father_district_id')->references('id')->on('districts');
            $table->foreign('father_province_id')->references('id')->on('districts');
            $table->foreign('father_country_id')->references('id')->on('countries');
            $table->foreign('mother_district_id')->references('id')->on('districts');
            $table->foreign('mother_province_id')->references('id')->on('districts');
            $table->foreign('mother_country_id')->references('id')->on('countries');
            $table->foreign('eme_district_id')->references('id')->on('districts');
            $table->foreign('eme_province_id')->references('id')->on('districts');
            $table->foreign('eme_country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
