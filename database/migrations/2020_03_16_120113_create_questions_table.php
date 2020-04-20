<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("question");
            $table->string("op1");
            $table->string("op2");
            $table->string("op3");
            $table->string("op4");
            $table->string("answer");
            $table->string("mcqId");
            $table->timestamps();

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
        Schema::dropIfExists('questions');
    }
}
