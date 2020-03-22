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
            $table->string("questionId");
            $table->string("studentId");
            $table->string("mcqId");
            $table->string("answer");
            $table->string("correct");
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
        Schema::dropIfExists('submitted_answers');
    }
}
