<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("question");
            $table->unsignedBigInteger("staffId");
            $table->unsignedBigInteger("semId");
            $table->unsignedBigInteger("subId");
            $table->timestamps();

            $table->foreign('semId')
                ->references('id')->on('semesters')
                ->onDelete('cascade');
            
            $table->foreign('staffId')
                ->references('id')->on('staff')
                ->onDelete('cascade');
            
            $table->foreign('subId')
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
        Schema::dropIfExists('assignments');
    }
}
