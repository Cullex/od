<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortListedApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_listed__applications', function (Blueprint $table) {
            $table->id();
            $table->string('decision');
            $table->char('interviewDate');
            $table->char('interviewTime');
            $table->string('applicantName');
            $table->string('applicantSurname');
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
        Schema::dropIfExists('short_listed__applications');
    }
}
