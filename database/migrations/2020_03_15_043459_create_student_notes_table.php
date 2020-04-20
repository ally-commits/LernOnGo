<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("file");
            $table->string("name");
            $table->unsignedBigInteger("staffId");
            $table->unsignedBigInteger("subjectId");
            $table->unsignedBigInteger("studentId");
            $table->string("status")->default("pending");
            $table->timestamps();

            $table->foreign('studentId')
                ->references('id')->on('users')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('student_notes');
    }
}
