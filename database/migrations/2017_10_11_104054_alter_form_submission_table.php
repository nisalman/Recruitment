<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFormSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->string('bankName')->nullable();
            $table->text('sport_id')->nullable();
            $table->text('NIDCopy')->nullable();
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
            $table->date('death')->nullable();
            $table->string('to')->nullable();
            $table->string('designation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
              $table->dropColumn(['bankName', 'NIDCopy', 'sport_id', 'end_year', 'start_year', 'to', 'user_id', 'designation']);
        });
    }
}
