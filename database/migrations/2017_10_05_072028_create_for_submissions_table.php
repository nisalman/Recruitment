<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nameEn');
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('NID');
            $table->date('birth');
            $table->string('sex');
            $table->string('religion')->nullable();
            $table->string('profession')->nullable();
            $table->string('currentThana')->nullable();
            $table->string('currentAddress')->nullable();
            $table->string('permenentThana')->nullable();
            $table->string('permenentAddress')->nullable();
            $table->string('mobile')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('annualIncome')->nullable();
            $table->string('bankAccNo')->nullable();
            $table->string('bankBranch')->nullable();
            $table->string('playerType')->nullable();
            $table->string('playerLevel')->nullable();
            $table->string('country')->nullable();
            $table->integer('federation_id')->nullable();
            $table->integer('club_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->tinyInteger('approval')->nullable();
            $table->string('description')->nullable();
            $table->integer('organizeExperience')->nullable();
            $table->integer('modifier')->nullable();
            $table->string('status')->nullable();
            $table->string('rating')->nullable();
            $table->string('trackingNumber')->nullable();
            $table->text('photo');
            $table->timestamps();

            /*   type 
                <option value="1">খেলোয়াড় </option>
                <option value="2">আম্পেয়ার </option>
                <option value="3">ক্রিরা সংগঠক </option>
                <option value="4">গার্ডসঃম্যান</option>
            */
            /*   level 
                <option value="1">আন্তর্জাতিক  </option>
                <option value="2">জাতীয়  </option>
                <option value="3">বিভাগ  </option>
                <option value="4">জেলা </option>
                <option value="5">উপজেলা  </option>
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_submissions');
    }
}
