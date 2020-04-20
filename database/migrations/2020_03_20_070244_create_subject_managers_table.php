<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("staffId");
            $table->unsignedBigInteger("subjectId");
            $table->timestamps();

            $table->foreign('staffId')
                ->references('id')->on('staff')
                ->onDelete('cascade');

            $table->foreign('subjectId')
                ->references('id')->on('subjects')
                ->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_managers');
    }
}
