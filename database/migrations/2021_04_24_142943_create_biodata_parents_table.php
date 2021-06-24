<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_parents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('biodata_id')->default(0);
            $table->string('father_name')->nullable();
            $table->integer('father_religion_id')->nullable();
            $table->integer('father_profession_id')->nullable();
            $table->integer('father_education_id')->nullable();
            $table->boolean('father_is_life')->default(true);
            $table->string('mother_name')->nullable();
            $table->integer('mother_religion_id')->nullable();
            $table->integer('mother_profession_id')->nullable();
            $table->integer('mother_education_id')->nullable();
            $table->boolean('mother_is_life')->default(true);
            $table->text('address')->nullable();
            $table->string('village', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->integer('province_id')->default(0);
            $table->string('postcode')->nullable();
            $table->char('citizen')->nullable()->comment('WNI / WNA');
            $table->char('country_code')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 50)->nullable();
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
        Schema::dropIfExists('biodata_parents');
    }
}
