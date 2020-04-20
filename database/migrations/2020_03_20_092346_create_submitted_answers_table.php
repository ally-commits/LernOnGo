<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("questionId");
            $table->unsignedBigInteger("studentId");
            $table->string("mcqId");
            $table->string("answer");
            $table->string("correct");
            $table->timestamps();

            $table->foreign('studentId')
                ->references('id')->on('users')
                ->onDelete('cascade'); 

            $table->foreign('questionId')
                ->references('id')->on('questions')
                ->onDelete('cascade');

            $table->foreign('mcqId')
                ->references('id')->on('m_c_q_s')
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
        Schema::dropIfExists('submitted_answers');
    }
}
