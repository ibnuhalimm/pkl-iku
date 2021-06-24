<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('biodata_id')->default(0);
            $table->integer('study_program_id')->default(0);
            $table->string('id_number')->unique();
            $table->string('nisn', 20)->nullable();
            $table->char('degree')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('month_entry')->nullable();
            $table->mediumInteger('year_entry')->nullable();
            $table->tinyInteger('month_grad')->nullable();
            $table->mediumInteger('year_grad')->nullable();
            $table->string('origin_school', 50)->nullable();
            $table->string('origin_mayor', 50)->nullable();
            $table->mediumInteger('origin_year_grad', 50)->nullable();
            $table->float('origin_score')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
