<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('local_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('startDateTime')->nullable();
            $table->string('endDateTime')->nullable();
            $table->string('itemId')->nullable();
            $table->string('eventId')->nullable();
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
        Schema::dropIfExists('local_events');
    }
}
