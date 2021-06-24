<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->string('id_card_number', 20)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('photo')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->char('gender')->nullable();
            $table->char('blood_type')->nullable();
            $table->integer('religion_id')->default(0);
            $table->tinyInteger('marital_status')->default(0);
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
        Schema::dropIfExists('biodatas');
    }
}
