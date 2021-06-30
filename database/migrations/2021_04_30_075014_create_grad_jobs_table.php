<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grad_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id');
            $table->date('date_start')->nullable();
            $table->float('sallary')->default(0);
            $table->boolean('job_category')->default(0);
            $table->boolean('emp_type')->default(0);
            $table->string('emp_agreement_image')->nullable();
            $table->integer('emp_contract_duration')->default(-1);
            $table->string('bus_company_name', 100)->nullable();
            $table->boolean('bus_type')->default(0);
            $table->string('bus_siup_no')->nullable();
            $table->string('bus_siup_image')->nullable();
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
        Schema::dropIfExists('grad_jobs');
    }
}
