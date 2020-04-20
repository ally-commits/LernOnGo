<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_c_q_s', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string("name");
            $table->unsignedBigInteger("staffId");
            $table->unsignedBigInteger("subjectId");
            $table->unsignedBigInteger("semId");
            $table->boolean("publish")->default(false);
            $table->timestamps();

            $table->foreign('subjectId')
                ->references('id')->on('subjects')
                ->onDelete('cascade');
            
            $table->foreign('staffId')
                ->references('id')->on('staff')
                ->onDelete('cascade');

            $table->foreign('semId')
                ->references('id')->on('semesters')
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
        Schema::dropIfExists('m_c_q_s');
    }
}
