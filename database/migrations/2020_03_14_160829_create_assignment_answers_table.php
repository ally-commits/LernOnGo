<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText("answer");
            $table->unsignedBigInteger("studentId");
            $table->unsignedBigInteger("assignmentId");
            $table->timestamps();

            $table->foreign('studentId')
                ->references('id')->on('users')
                ->onDelete('cascade');
            
            $table->foreign('assignmentId')
                ->references('id')->on('assignments')
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
        Schema::dropIfExists('assignment_answers');
    }
}
