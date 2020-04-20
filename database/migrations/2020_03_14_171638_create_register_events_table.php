<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("studentId");
            $table->unsignedBigInteger("eventId");
            $table->timestamps();

            $table->foreign('studentId')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('eventId')
                ->references('id')->on('events')
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
        Schema::dropIfExists('register_events');
    }
}
