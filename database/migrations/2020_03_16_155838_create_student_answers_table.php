<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("answer");
            $table->integer("count");
            $table->unsignedBigInteger("studentId");
            $table->string("mcqId");
            $table->timestamps();
 
            $table->foreign('studentId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('student_answers');
    }
}
