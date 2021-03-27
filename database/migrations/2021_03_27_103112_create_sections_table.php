<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('applying_grade_id')->unsigned();
            $table->string('title', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sections', function (Blueprint $table){
            $table->foreign('applying_grade_id')->references('id')->on('applying_grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
